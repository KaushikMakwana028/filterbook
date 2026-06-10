<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller
{
    private $admin;
    private $store_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
        $this->load->model('Customer_model');
        $this->load->library('session');
        $this->load->library('subscription_guard');

        $this->admin = $this->session->userdata('admin');
        if (!$this->admin) {
            redirect(site_url('admin/login'));
        }

        $this->subscription_guard->enforce((int) $this->admin['id']);

        $this->store_id = (int) $this->admin['id'];
    }

    private function find_product_by_name($productName)
    {
        $normalizedName = strtolower(trim((string) $productName));

        if ($normalizedName === '') {
            return null;
        }

        $products = $this->db
            ->from('products')
            ->where('user_id', $this->store_id)
            ->order_by('id', 'DESC')
            ->get()
            ->result();

        foreach ($products as $product) {
            $candidateName = strtolower(trim((string) ($product->name ?? '')));
            if ($candidateName === $normalizedName) {
                return $product;
            }
        }

        return null;
    }
public function save_order()
{
    $admin = $this->admin;
    
    $request = $_POST;
    $paymentType = ($request['customRadio'] === 'installment') ? 1 : 0;
    $price = (float) $request['price'];
    $downPayment = (float) ($request['down_payment'] === '' ? 0 : $request['down_payment']);
    $emiMonths = max(0, (int) $request['emi_month']);
    $serviceInterval = max(0, (int) $request['service_interval']);
    $totalServices = max(0, (int) $request['total_services']);

    // ── Required fields validation ────────────────────────────────
    if (empty($request['product_name']) || empty($request['customerMobile']) ||
        empty($request['purchasedate']) || empty($request['price'])) {
        $this->session->set_flashdata('error', 'Customer mobile, product name, purchase date and price are required.');
        redirect('admin/orders/add');
        return;
    }

    if (!$this->isValidDate($request['purchasedate'])) {
        $this->session->set_flashdata('error', 'Purchase date must be in valid format.');
        redirect('admin/orders/add');
        return;
    }

    if (!empty($request['start_service_date']) && !$this->isValidDate($request['start_service_date'])) {
        $this->session->set_flashdata('error', 'Start service date must be in valid format.');
        redirect('admin/orders/add');
        return;
    }

    if (strlen($request['customerMobile']) < 10) {
        $this->session->set_flashdata('error', 'Please enter a valid customer mobile number.');
        redirect('admin/orders/add');
        return;
    }

    if ($price <= 0) {
        $this->session->set_flashdata('error', 'Price must be greater than 0.');
        redirect('admin/orders/add');
        return;
    }

    if ($downPayment < 0 || $downPayment > $price) {
        $this->session->set_flashdata('error', 'Down payment must be between 0 and order price.');
        redirect('admin/orders/add');
        return;
    }

    // ── EMI validation ────────────────────────────────────────────
    if ($paymentType === 1) {
        if ($emiMonths <= 0 || empty($request['emi_date'])) {
            $this->session->set_flashdata('error', 'EMI month and EMI date are required for EMI orders.');
            redirect('admin/orders/add');
            return;
        }

        if (!$this->isValidDate($request['emi_date'])) {
            $this->session->set_flashdata('error', 'EMI date must be in valid format.');
            redirect('admin/orders/add');
            return;
        }
    }

    // ── Customer handling ─────────────────────────────────────────
    $customerId = (int) $request['customer_id'];
    $customer   = null;

    if ($customerId > 0) {
        $customer = $this->db
            ->where('id', $customerId)
            ->where('store_id', $admin['id'])
            ->get('customers')
            ->row();

        if (!$customer) {
            $this->session->set_flashdata('error', 'Customer not found.');
            redirect('admin/orders/add');
            return;
        }
    } else {
        $customer = $this->db
            ->where('mobile', $request['customerMobile'])
            ->where('store_id', $admin['id'])
            ->get('customers')
            ->row();

        if (!$customer) {
            if (empty($request['customerName'])) {
                $this->session->set_flashdata('error', 'Customer name is required when customer is not found.');
                redirect('admin/orders/add');
                return;
            }

            $this->db->insert('customers', [
                'store_id' => $admin['id'],
                'name'     => $request['customerName'],
                'mobile'   => $request['customerMobile'],
                'address'  => $request['address'],
            ]);

            $customerId = (int) $this->db->insert_id();
            $customer   = $this->db->where('id', $customerId)->get('customers')->row();
        } else {
            $customerId = (int) $customer->id;
        }
    }

    // ── EMI amount calculation ────────────────────────────────────
    $emiAmount = ($paymentType === 1 && $emiMonths > 0)
        ? round(($price - $downPayment) / $emiMonths, 2)
        : 0;

    // ── Service start date ────────────────────────────────────────
    $startServiceDate = (!empty($request['start_service_date']))
        ? $request['start_service_date']
        : date('Y-m-d', strtotime('+' . $serviceInterval . ' month', strtotime($request['purchasedate'])));

    $this->db->trans_start();

    // ── Insert order ──────────────────────────────────────────────
    $this->db->insert('orders', [
        'store_id'           => $admin['id'],
        'customer_id'        => $customerId,
        'product_name'       => $request['product_name'],
        'product_modal'      => isset($request['product_modal']) ? $request['product_modal'] : '',
        'date_of_purchase'   => $request['purchasedate'],
        'price'              => $price,
        'down_payment'       => $downPayment,
        'emi_amount'         => $emiAmount,
        'emi_duration'       => $emiMonths,
        'payment_type'       => $paymentType,
        'service_interval'   => $serviceInterval,
        'total_services'     => $totalServices,
        'emi_date'           => !empty($request['emi_date']) ? $request['emi_date'] : null,
    ]);

    $orderId = (int) $this->db->insert_id();

    // ── Service log ───────────────────────────────────────────────
    for ($i = 1; $i <= $totalServices; $i++) {
        $serviceDate = date(
            'Y-m-d',
            strtotime('+' . ($serviceInterval * ($i - 1)) . ' month', strtotime($startServiceDate))
        );

        $this->db->insert('service_log', [
            'order_id'        => $orderId,
            'customer_id'     => $customerId,
            'service_number'  => $i,
            'assign_to'       => 0,
            'status'          => 0,
            'customer_status' => 0,
            'service_date'    => $serviceDate,
            'created_at'      => date('Y-m-d H:i:s'),
        ]);
    }

    // ── EMI log ───────────────────────────────────────────────────
    if ($paymentType === 1) {
        for ($i = 1; $i <= $emiMonths; $i++) {
            $this->db->insert('emi_logs', [
                'order_id'        => $orderId,
                'customer_id'     => $customerId,
                'emi_number'      => $i,
                'status'          => 0,
                'status_customer' => 0,
                'emi_date'        => date(
                    'Y-m-d',
                    strtotime('+' . ($i - 1) . ' month', strtotime($request['emi_date']))
                ),
                'created_at'      => date('Y-m-d H:i:s'),
            ]);
        }
    }

    $this->db->trans_complete();

    // Check transaction status
    if ($this->db->trans_status() === FALSE) {
        $this->session->set_flashdata('error', 'Failed to create order. Please try again.');
        redirect('admin/orders/add');
        return;
    }

    // ── WhatsApp Bill Sending ─────────────────────────────────────
    $whatsappSent  = false;
    $whatsappError = null;

    try {
        log_message('info', '[WA] Starting WhatsApp bill for order #' . $orderId);

        // Get complete order details
        $order = $this->db->where('id', $orderId)->get('orders')->row();
        $store = $this->db->where('id', $admin['id'])->get('users')->row();

        // Generate PDF
        log_message('info', '[WA] Generating PDF...');
        $pdfPath = $this->generateBillPDF($order, $store, $customer);
        log_message('info', '[WA] PDF generated at: ' . $pdfPath);

        if (!file_exists($pdfPath)) {
            throw new Exception('PDF file not found at path: ' . $pdfPath);
        }
        log_message('info', '[WA] PDF size: ' . filesize($pdfPath) . ' bytes');

        // Upload to Meta
        log_message('info', '[WA] Uploading PDF to Meta...');
        $uploadResult = $this->uploadPDFToWhatsApp($pdfPath);
        log_message('info', '[WA] Upload result: ' . json_encode($uploadResult));

        $mediaId = $uploadResult['media_id'] ?? null;
        $uploadError = $uploadResult['error'] ?? null;

        if ($uploadError) {
            throw new Exception('Meta upload error: ' . json_encode($uploadError));
        }

        if (!$mediaId) {
            throw new Exception('No media_id returned from Meta. Full response: ' . json_encode($uploadResult));
        }

        log_message('info', '[WA] Media ID: ' . $mediaId);

        // Send WhatsApp message
        log_message('info', '[WA] Sending WhatsApp message to: ' . $customer->mobile);
        $sendResult = $this->sendWhatsAppBill($customer->mobile, $mediaId, $order, $customer, $store);
        log_message('info', '[WA] Send result: ' . json_encode($sendResult));

        if (isset($sendResult['error'])) {
            throw new Exception('Meta send error: ' . json_encode($sendResult['error']));
        }

        $whatsappSent = true;
        log_message('info', '[WA] WhatsApp bill sent successfully for order #' . $orderId);

        // Cleanup
        if (file_exists($pdfPath)) {
            unlink($pdfPath);
            log_message('info', '[WA] Temp PDF deleted.');
        }

    } catch (Exception $e) {
        $whatsappError = $e->getMessage();
        log_message('error', '[WA] FAILED for order #' . $orderId . ': ' . $whatsappError);
    }

    // Set success message
    if ($whatsappSent) {
        $this->session->set_flashdata('success', 'Order created successfully and invoice sent via WhatsApp!');
    } else {
        $msg = 'Order created successfully.';
        if ($whatsappError) {
            $msg .= ' However, WhatsApp bill could not be sent: ' . $whatsappError;
        }
        $this->session->set_flashdata('warning', $msg);
    }

    redirect('admin/orders');
}

// ── Helper method for date validation ─────────────────────────
private function isValidDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

// ── PDF Generation (same as API) ───────────────────────────────
private function generateBillPDF($order, $store, $customer)
{
    require_once APPPATH . '../vendor/tecnickcom/tcpdf/tcpdf.php';

    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    $pdf->SetCreator('FilterBook');
    $pdf->SetAuthor($store->name);
    $pdf->SetTitle('Invoice #' . str_pad($order->id, 6, '0', STR_PAD_LEFT));
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(true, 15);
    $pdf->AddPage();

    // Store header
    $pdf->SetFont('helvetica', 'B', 18);
    $pdf->Cell(0, 10, $store->name, 0, 1, 'C');

    $pdf->SetFont('helvetica', '', 10);
    if (!empty($store->address)) {
        $pdf->Cell(0, 6, $store->address, 0, 1, 'C');
    }
    $pdf->Cell(0, 6, 'Mobile: ' . $store->mobile, 0, 1, 'C');
    if (!empty($store->email)) {
        $pdf->Cell(0, 6, 'Email: ' . $store->email, 0, 1, 'C');
    }

    $pdf->Ln(3);
    $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
    $pdf->Ln(4);

    // Invoice title
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 8, 'INVOICE', 0, 1, 'C');

    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(95, 6, 'Invoice No: #' . str_pad($order->id, 6, '0', STR_PAD_LEFT), 0, 0, 'L');
    $pdf->Cell(95, 6, 'Date: ' . date('d-m-Y', strtotime($order->date_of_purchase)), 0, 1, 'R');

    $pdf->Ln(3);
    $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
    $pdf->Ln(4);

    // Customer details
    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->Cell(0, 7, 'Bill To:', 0, 1);

    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(0, 6, 'Name    : ' . $customer->name, 0, 1);
    $pdf->Cell(0, 6, 'Mobile  : ' . $customer->mobile, 0, 1);
    if (!empty($customer->address)) {
        $pdf->Cell(0, 6, 'Address : ' . $customer->address, 0, 1);
    }

    $pdf->Ln(3);
    $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
    $pdf->Ln(4);

    // Product table
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(90, 8, 'Product', 1, 0, 'L', true);
    $pdf->Cell(40, 8, 'Model', 1, 0, 'C', true);
    $pdf->Cell(45, 8, 'Price', 1, 1, 'R', true);

    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Cell(90, 8, $order->product_name, 1, 0, 'L');
    $pdf->Cell(40, 8, !empty($order->product_modal) ? $order->product_modal : '-', 1, 0, 'C');
    $pdf->Cell(45, 8, 'Rs. ' . number_format($order->price, 2), 1, 1, 'R');

    $pdf->Ln(3);

    // Payment summary
    if ($order->payment_type == 1) {
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(130, 7, 'Down Payment:', 0, 0, 'R');
        $pdf->Cell(55, 7, 'Rs. ' . number_format($order->down_payment, 2), 0, 1, 'R');

        $pdf->Cell(130, 7, 'EMI Amount (x' . $order->emi_duration . ' months):', 0, 0, 'R');
        $pdf->Cell(55, 7, 'Rs. ' . number_format($order->emi_amount, 2) . '/mo', 0, 1, 'R');

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(130, 7, 'Total Payable:', 0, 0, 'R');
        $pdf->Cell(55, 7, 'Rs. ' . number_format($order->price, 2), 0, 1, 'R');

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(130, 7, 'Payment Type:', 0, 0, 'R');
        $pdf->Cell(55, 7, 'EMI', 0, 1, 'R');
    } else {
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(130, 7, 'Total Amount:', 0, 0, 'R');
        $pdf->Cell(55, 7, 'Rs. ' . number_format($order->price, 2), 0, 1, 'R');

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(130, 7, 'Payment Type:', 0, 0, 'R');
        $pdf->Cell(55, 7, 'Cash', 0, 1, 'R');
    }

    // Service schedule
    if ($order->total_services > 0) {
        $pdf->Ln(4);
        $pdf->Line(15, $pdf->GetY(), 195, $pdf->GetY());
        $pdf->Ln(4);

        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(0, 7, 'Service Schedule:', 0, 1);

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(40, 7, 'Service #', 1, 0, 'C', true);
        $pdf->Cell(85, 7, 'Scheduled Date', 1, 0, 'C', true);
        $pdf->Cell(60, 7, 'Status', 1, 1, 'C', true);

        $serviceLogs = $this->db
            ->where('order_id', $order->id)
            ->order_by('service_number', 'ASC')
            ->get('service_log')
            ->result();

        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetFillColor(255, 255, 255);
        foreach ($serviceLogs as $log) {
            $pdf->Cell(40, 7, 'Service ' . $log->service_number, 1, 0, 'C');
            $pdf->Cell(85, 7, date('d-m-Y', strtotime($log->service_date)), 1, 0, 'C');
            $pdf->Cell(60, 7, 'Scheduled', 1, 1, 'C');
        }
    }

    // Footer
    $pdf->Ln(8);
    $pdf->SetFont('helvetica', 'I', 9);
    $pdf->Cell(0, 6, 'Thank you for your purchase!', 0, 1, 'C');
    $pdf->Cell(0, 6, $store->name . ' | ' . $store->mobile, 0, 1, 'C');

    // Save to tmp
    $fileName = 'bill_order_' . $order->id . '_' . time() . '.pdf';
    $filePath = sys_get_temp_dir() . '/' . $fileName;
    $pdf->Output($filePath, 'F');

    return $filePath;
}

// ── Upload PDF to WhatsApp (same as API) ───────────────────────
private function uploadPDFToWhatsApp($filePath)
{
    $phoneNumberId = $this->config->item('whatsapp_phone_number_id');
    $accessToken   = $this->config->item('whatsapp_access_token');

    $url = 'https://graph.facebook.com/v19.0/' . $phoneNumberId . '/media';

    log_message('info', '[WA] Upload URL: ' . $url);

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $accessToken,
        ],
        CURLOPT_POSTFIELDS => [
            'messaging_product' => 'whatsapp',
            'type'              => 'application/pdf',
            'file'              => new CURLFile($filePath, 'application/pdf', basename($filePath)),
        ],
    ]);

    $response = curl_exec($curl);
    $curlError = curl_error($curl);
    $httpCode  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    log_message('info', '[WA] Upload HTTP code: ' . $httpCode);
    log_message('info', '[WA] Upload raw response: ' . $response);

    if ($curlError) {
        log_message('error', '[WA] cURL error on upload: ' . $curlError);
        return ['media_id' => null, 'error' => $curlError];
    }

    $result = json_decode($response, true);

    return [
        'media_id' => $result['id'] ?? null,
        'error'    => $result['error'] ?? null,
    ];
}

// ── Send WhatsApp Bill (same as API) ───────────────────────────
private function sendWhatsAppBill($customerMobile, $mediaId, $order, $customer, $store)
{
    $phoneNumberId = $this->config->item('whatsapp_phone_number_id');
    $accessToken   = $this->config->item('whatsapp_access_token');

    $url = 'https://graph.facebook.com/v19.0/' . $phoneNumberId . '/messages';

    $mobile = '91' . ltrim($customerMobile, '0');

    log_message('info', '[WA] Sending to mobile: ' . $mobile);

    $body = [
        'messaging_product' => 'whatsapp',
        'to'                => $mobile,
        'type'              => 'document',
        'document'          => [
            'id'       => $mediaId,
            'filename' => 'Invoice_' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf',
            'caption'  =>
                'Hello ' . $customer->name . "!\n\n" .
                'Thank you for your purchase at *' . $store->name . '*.' . "\n" .
                'Please find your invoice attached.' . "\n\n" .
                '*Order Summary*' . "\n" .
                'Product  : ' . $order->product_name . "\n" .
                'Amount   : Rs. ' . number_format($order->price, 2) . "\n" .
                'Payment  : ' . ($order->payment_type == 1 ? 'EMI - Rs.' . number_format($order->emi_amount, 2) . '/mo' : 'Cash') . "\n\n" .
                $store->name . ' | ' . $store->mobile,
        ],
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ],
        CURLOPT_POSTFIELDS => json_encode($body),
    ]);

    $response  = curl_exec($curl);
    $httpCode  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    log_message('info', '[WA] Send HTTP code: ' . $httpCode);
    log_message('info', '[WA] Send raw response: ' . $response);

    return json_decode($response, true);
}
    private function decrease_stock_for_sale($productName)
    {
        $product = $this->find_product_by_name($productName);

        if (!$product) {
            return [true, null];
        }

        $currentQty = (int) ($product->quantity ?? 0);
        if ($currentQty < 1) {
            return [false, 'Selected product is out of stock. Please update purchase stock before making a sale.'];
        }

        $this->db
            ->where('id', (int) $product->id)
            ->where('user_id', $this->store_id)
            ->update('products', [
                'quantity' => $currentQty - 1
            ]);

        return [true, null];
    }

    private function restore_stock_for_sale($productName)
    {
        $product = $this->find_product_by_name($productName);

        if (!$product) {
            return;
        }

        $this->db
            ->where('id', (int) $product->id)
            ->where('user_id', $this->store_id)
            ->update('products', [
                'quantity' => (int) ($product->quantity ?? 0) + 1
            ]);
    }

    public function index()
    {
        $data['customers'] = $this->Order_model->get_customers_with_orders($this->store_id);

        $this->load->view('admin/header');
        $this->load->view('admin/orders_list', $data);
        $this->load->view('admin/footer');
    }

    public function new_order()
    {
        $data['customers'] = $this->Customer_model->get_customers($this->store_id);
        $data['products'] = $this->Order_model->get_products($this->store_id);

        $this->load->view('admin/header');
        $this->load->view('admin/new_order', $data);
        $this->load->view('admin/footer');
    }

    public function add_order()
{
    $methodError = $this->ensureMethod('POST');
    if ($methodError !== null) return $methodError;

    list($user, $payload, $errorResponse) = $this->getAuthenticatedUserFromToken();
    if ($errorResponse !== null) return $errorResponse;

    $request = $this->getOrderRequestData();

    $paymentType = $this->normalizePaymentType($request['payment_type']);
    $price = (float) $request['price'];
    $downPayment = (float) ($request['down_payment'] === '' ? 0 : $request['down_payment']);
    $emiMonths = max(0, (int) $request['emi_month']);
    $serviceInterval = max(0, (int) $request['service_interval']);
    $totalServices = max(0, (int) $request['total_services']);

    // ✅ Validation
    if ($request['product_name'] === '' || $request['customer_mobile'] === '' || $request['date_of_purchase'] === '' || $request['price'] === '') {
        return $this->errorResponse(400, 'Customer mobile, product name, purchase date and price are required.');
    }

    if (!$this->isValidDate($request['date_of_purchase'])) {
        return $this->errorResponse(400, 'Purchase date must be in Y-m-d format.');
    }

    if (!empty($request['start_service_date']) && !$this->isValidDate($request['start_service_date'])) {
        return $this->errorResponse(400, 'Start service date must be in Y-m-d format.');
    }

    if (strlen($request['customer_mobile']) < 10) {
        return $this->errorResponse(400, 'Please enter a valid customer mobile number.');
    }

    if ($price <= 0) {
        return $this->errorResponse(400, 'Price must be greater than 0.');
    }

    if ($downPayment < 0 || $downPayment > $price) {
        return $this->errorResponse(400, 'Down payment must be between 0 and order price.');
    }

    // ✅ EMI validation
    if ($paymentType === 1) {
        if ($emiMonths <= 0 || $request['emi_date'] === '') {
            return $this->errorResponse(400, 'EMI month and EMI date are required for EMI orders.');
        }

        if (!$this->isValidDate($request['emi_date'])) {
            return $this->errorResponse(400, 'EMI date must be in Y-m-d format.');
        }
    }

    // ✅ Customer handling
    $customerId = (int) $request['customer_id'];

    if ($customerId > 0) {
        $customer = $this->getOwnedCustomer($customerId, (int) $user->id);
        if (!$customer) {
            return $this->errorResponse(400, 'Customer not found.');
        }
    } else {
        $customer = $this->db
            ->where('mobile', $request['customer_mobile'])
            ->where('store_id', (int) $user->id)
            ->get('customers')
            ->row();

        if (!$customer) {
            if ($request['customer_name'] === '') {
                return $this->errorResponse(400, 'Customer name is required.');
            }

            $this->db->insert('customers', [
                'store_id' => (int) $user->id,
                'name' => $request['customer_name'],
                'mobile' => $request['customer_mobile'],
                'address' => $request['address'],
            ]);

            $customerId = (int) $this->db->insert_id();
        } else {
            $customerId = (int) $customer->id;
        }
    }

    // ✅ EMI Calculation
    $emiAmount = ($paymentType === 1 && $emiMonths > 0)
        ? round(($price - $downPayment) / $emiMonths, 2)
        : 0;

    $this->db->trans_start();

    // ✅ Insert Order
    $this->db->insert('orders', [
        'store_id' => (int) $user->id,
        'customer_id' => $customerId,
        'product_name' => $request['product_name'],
        'product_modal' => $request['product_modal'],
        'date_of_purchase' => $request['date_of_purchase'],
        'price' => $price,
        'down_payment' => $downPayment,
        'emi_amount' => $emiAmount,
        'emi_duration' => $emiMonths,
        'payment_type' => $paymentType,
        'service_interval' => $serviceInterval,
        'total_services' => $totalServices,
    ]);

    $orderId = (int) $this->db->insert_id();

    // ✅ 🔥 EXACT WEB LOGIC FOR SERVICE START DATE
    $purchaseDate = $request['date_of_purchase'];
    $startServiceDate = $request['start_service_date'];

    if (empty($startServiceDate)) {
        $startServiceDate = date('Y-m-d', strtotime('+' . $serviceInterval . ' month', strtotime($purchaseDate)));
    }

    for ($i = 1; $i <= $totalServices; $i++) {
        $serviceDate = date(
            'Y-m-d',
            strtotime('+' . ($serviceInterval * ($i - 1)) . ' month', strtotime($startServiceDate))
        );

        $this->db->insert('service_log', [
            'order_id' => $orderId,
            'customer_id' => $customerId,
            'service_number' => $i,
            'assign_to' => 0,
            'status' => 0,
            'customer_status' => 0,
            'service_date' => $serviceDate,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // ✅ EMI Logic (same as before)
    if ($paymentType === 1) {
        for ($i = 1; $i <= $emiMonths; $i++) {
            $this->db->insert('emi_logs', [
                'order_id' => $orderId,
                'customer_id' => $customerId,
                'emi_number' => $i,
                'status' => 0,
                'status_customer' => 0,
                'emi_date' => date(
                    'Y-m-d',
                    strtotime('+' . ($i - 1) . ' month', strtotime($request['emi_date']))
                ),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    $this->db->trans_complete();

    $order = $this->getOrderById($orderId, (int) $user->id);

    http_response_code(200);
    echo json_encode([
        'code' => 200,
        'status' => true,
        'message' => 'Order added successfully.',
        'data' => $this->buildOrderPayload($order),
    ]);
}

    public function check_customer_mobile()
    {
        $mobile = preg_replace('/\D+/', '', (string) $this->input->post('mobile', TRUE));

        $customer = $this->db
            ->where('mobile', $mobile)
            ->where('store_id', $this->store_id)
            ->get('customers')
            ->row();

        header('Content-Type: application/json');

        if ($customer) {
            echo json_encode(['status' => true, 'data' => $customer]);
        } else {
            echo json_encode(['status' => false]);
        }
    }

    public function lookup_existing_order()
    {
        $mobile = preg_replace('/\D+/', '', (string) $this->input->post('mobile', true));
        $product_name = trim((string) $this->input->post('product_name', true));

        $customer = null;
        $order = null;
        $product = null;

        if ($mobile !== '') {
            $customer = $this->db
                ->where('mobile', $mobile)
                ->where('store_id', $this->store_id)
                ->get('customers')
                ->row();
        }

        if (!$order && $product_name !== '') {
            $this->db->from('orders');
            $this->db->where('store_id', $this->store_id);

            if ($product_name !== '') {
                $this->db->where('product_name', $product_name);
            }

            $order = $this->db
                ->order_by('date_of_purchase', 'DESC')
                ->order_by('id', 'DESC')
                ->get()
                ->row();
        }

        if ($product_name !== '') {
            $product = $this->db
                ->from('products')
                ->where('user_id', $this->store_id)
                ->where('LOWER(name)', strtolower($product_name))
                ->order_by('id', 'DESC')
                ->get()
                ->row();
        }

        if ($order && (int) $order->payment_type === 1) {
            $first_emi = $this->db
                ->select('emi_date')
                ->where('order_id', (int) $order->id)
                ->order_by('emi_number', 'ASC')
                ->get('emi_logs')
                ->row();

            $order->emi_date = $first_emi ? $first_emi->emi_date : '';
        }

        if ($order) {
            $first_service = $this->db
                ->select('service_date')
                ->where('order_id', (int) $order->id)
                ->order_by('service_number', 'ASC')
                ->get('service_log')
                ->row();

            $order->start_service_date = $first_service ? $first_service->service_date : '';
        }

        header('Content-Type: application/json');
        echo json_encode([
            'status' => (bool) ($customer || $order || $product),
            'customer' => $customer,
            'order' => $order,
            'product' => $product,
        ]);
    }

    public function delete($id)
    {
        if (!$id) {
            show_404();
        }

        $order = $this->db
            ->where('id', $id)
            ->where('store_id', $this->store_id)
            ->get('orders')
            ->row();

        if (!$order) {
            show_404();
        }

        $customer_id = (int) $order->customer_id;
        $this->db->trans_start();

        $this->restore_stock_for_sale($order->product_name);

        $this->db->where('order_id', $id);
        $this->db->delete('emi_logs');

        $this->db->where('order_id', $id);
        $this->db->delete('service_log');

        $this->db->where('id', $id);
        $this->db->where('store_id', $this->store_id);
        $this->db->delete('orders');

        $this->db->trans_complete();

        $this->session->set_flashdata('success', 'Order deleted successfully');
        redirect(site_url('admin/orders/customer/' . $customer_id));
    }

    public function edit($id)
    {
        $order = $this->db
            ->where('id', $id)
            ->where('store_id', $this->store_id)
            ->get('orders')
            ->row();

        if (!$order) {
            show_404();
        }

        $data['order'] = $order;
        $data['emis'] = $this->db
            ->where('order_id', $id)
            ->order_by('emi_number', 'ASC')
            ->get('emi_logs')
            ->result();

        $this->load->view('admin/header');
        if ($order->payment_type == 1) {
            $this->load->view('admin/edit_order_emi', $data);
        } else {
            $this->load->view('admin/edit_order_cash', $data);
        }
        $this->load->view('admin/footer');
    }

    public function update_order_emi()
    {
        $id = $this->input->post('id');
        $order = $this->db
            ->where('id', $id)
            ->where('store_id', $this->store_id)
            ->get('orders')
            ->row();

        if (!$order) {
            show_404();
        }

        $price = (float) $this->input->post('price');
        $down = (float) $this->input->post('down_payment');
        $months = (int) $this->input->post('emi_duration');
        $remaining = max(0, $price - $down);
        $emi_amount = $months > 0 ? ($remaining / $months) : 0;
        $newProductName = trim((string) $this->input->post('product_name', true));

        if (strtolower(trim((string) $order->product_name)) !== strtolower($newProductName)) {
            $this->restore_stock_for_sale($order->product_name);

            list($stockOk, $stockMessage) = $this->decrease_stock_for_sale($newProductName);
            if (!$stockOk) {
                $this->decrease_stock_for_sale($order->product_name);
                $this->session->set_flashdata('error', $stockMessage);
                redirect(site_url('admin/orders/edit/' . (int) $id));
                return;
            }
        }

        $this->db->where('id', $id);
        $this->db->where('store_id', $this->store_id);
        $this->db->update('orders', [
            'product_name' => $newProductName,
            'price' => $price,
            'down_payment' => $down,
            'emi_amount' => $emi_amount,
            'emi_duration' => $months,
            'payment_type' => 1
        ]);

        $start_date = $order->date_of_purchase;

        $this->db->where('order_id', $id);
        $this->db->where('status', 0);
        $this->db->delete('emi_logs');

        for ($i = 1; $i <= $months; $i++) {
            $emi = [
                'order_id' => $id,
                'customer_id' => $order->customer_id,
                'emi_number' => $i,
                'status' => 0,
                'emi_date' => date('Y-m-d', strtotime("+" . ($i - 1) . " month", strtotime($start_date))),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('emi_logs', $emi);
        }

        redirect(site_url('admin/orders/customer/' . $order->customer_id));
    }

    public function update_order()
    {
        $id = $this->input->post('id');
        $order = $this->db
            ->where('id', $id)
            ->where('store_id', $this->store_id)
            ->get('orders')
            ->row();

        if (!$order) {
            show_404();
        }

        $newProductName = trim((string) $this->input->post('product_name', true));

        if (strtolower(trim((string) $order->product_name)) !== strtolower($newProductName)) {
            $this->restore_stock_for_sale($order->product_name);

            list($stockOk, $stockMessage) = $this->decrease_stock_for_sale($newProductName);
            if (!$stockOk) {
                $this->decrease_stock_for_sale($order->product_name);
                $this->session->set_flashdata('error', $stockMessage);
                redirect(site_url('admin/orders/edit/' . (int) $id));
                return;
            }
        }

        $this->db->where('id', $id);
        $this->db->where('store_id', $this->store_id);
        $this->db->update('orders', [
            'product_name' => $newProductName,
            'date_of_purchase' => $this->input->post('purchasedate'),
            'price' => $this->input->post('price'),
            'payment_type' => 0,
            'service_interval' => $this->input->post('service_interval'),
            'total_services' => $this->input->post('total_services')
        ]);

        $this->session->set_flashdata('success', 'Order updated successfully');
        redirect(site_url('admin/orders/customer/' . $order->customer_id));
    }

    public function view($id)
    {
        return $this->customer($id);
    }

    public function customer($customer_id)
    {
        $customer = $this->Order_model->get_customer((int) $customer_id, $this->store_id);

        if (!$customer) {
            show_404();
        }

        $orders = $this->Order_model->get_customer_orders((int) $customer_id, $this->store_id);
        $total_value = 0;
        foreach ($orders as $order) {
            $total_value += (float) $order->price;
        }

        $data['customer'] = $customer;
        $data['orders'] = $orders;
        $data['total_orders'] = count($orders);
        $data['total_value'] = $total_value;

        $this->load->view('admin/header');
        $this->load->view('admin/order_customer_detail', $data);
        $this->load->view('admin/footer');
    }

    public function edit_customer($customer_id)
    {
        $customer = $this->db
            ->where('id', (int) $customer_id)
            ->where('store_id', $this->store_id)
            ->get('customers')
            ->row();

        if (!$customer) {
            show_404();
        }

        $data['customer'] = $customer;

        $this->load->view('admin/header');
        $this->load->view('admin/edit_customer', $data);
        $this->load->view('admin/footer');
    }

    public function update_customer($customer_id)
    {
        $customer = $this->db
            ->where('id', (int) $customer_id)
            ->where('store_id', $this->store_id)
            ->get('customers')
            ->row();

        if (!$customer) {
            show_404();
        }

        $name = trim((string) $this->input->post('name', true));
        $mobile = preg_replace('/\D+/', '', (string) $this->input->post('mobile', true));
        $address = trim((string) $this->input->post('address', true));

        if ($name === '' || $mobile === '') {
            $this->session->set_flashdata('error', 'Name and mobile are required');
            redirect(site_url('admin/orders/edit_customer/' . (int) $customer_id));
        }

        $mobile_exists = $this->db
            ->where('mobile', $mobile)
            ->where('store_id', $this->store_id)
            ->where('id !=', (int) $customer_id)
            ->get('customers')
            ->row();

        if ($mobile_exists) {
            $this->session->set_flashdata('error', 'This mobile number is already used by another customer');
            redirect(site_url('admin/orders/edit_customer/' . (int) $customer_id));
        }

        $this->db->where('id', (int) $customer_id);
        $this->db->where('store_id', $this->store_id);
        $this->db->update('customers', [
            'name' => $name,
            'mobile' => $mobile,
            'address' => $address
        ]);

        $this->session->set_flashdata('success', 'Customer updated successfully');
        redirect(site_url('admin/orders/customer/' . (int) $customer_id));
    }

    public function delete_customer($customer_id)
    {
        $customer = $this->db
            ->where('id', (int) $customer_id)
            ->where('store_id', $this->store_id)
            ->get('customers')
            ->row();

        if (!$customer) {
            show_404();
        }

        $order_ids = $this->db
            ->select('id')
            ->where('customer_id', (int) $customer_id)
            ->where('store_id', $this->store_id)
            ->get('orders')
            ->result();

        $this->db->trans_start();

        if (!empty($order_ids)) {
            $order_ids = array_map(function ($order) {
                return (int) $order->id;
            }, $order_ids);

            $this->db->where_in('order_id', $order_ids);
            $this->db->delete('emi_logs');

            $this->db->where_in('order_id', $order_ids);
            $this->db->delete('service_log');
        }

        $this->db->where('customer_id', (int) $customer_id);
        $this->db->where('store_id', $this->store_id);
        $this->db->delete('orders');

        $this->db->where('id', (int) $customer_id);
        $this->db->where('store_id', $this->store_id);
        $this->db->delete('customers');

        $this->db->trans_complete();

        $this->session->set_flashdata('success', 'Customer and related orders deleted successfully');
        redirect(site_url('admin/orders'));
    }

    public function update_emi($id)
    {
        $this->db->where('id', $id);
        $this->db->update('emi_logs', [
            'status' => 1,
            'update_at' => date('Y-m-d')
        ]);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_service($id)
    {
        $this->db->where('id', $id);
        $this->db->update('service_log', [
            'status' => 1,
            'update_at' => date('Y-m-d')
        ]);

        redirect($_SERVER['HTTP_REFERER']);
    }
}
