<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plan_model extends CI_Model
{
    private $table = 'user_subscriptions';
    private $catalogTable = 'plan_catalog';
    private $paymentTable = 'plan_payment_orders';
    private $tableColumns = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->ensureSubscriptionTable();
        $this->ensureSubscriptionDateTimeColumns();
        $this->ensurePlanCatalogTable();
        $this->ensurePaymentTable();
    }

    private function ensureSubscriptionTable()
    {
        if ($this->db->table_exists($this->table)) {
            return;
        }

        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'plan_code' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'plan_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'duration_days' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'is_trial' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'active',
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'start_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'end_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('user_id');
        $this->dbforge->create_table($this->table, true);
    }

    private function ensureSubscriptionDateTimeColumns()
    {
        if (!$this->db->table_exists($this->table)) {
            return;
        }

        $columnsToAdd = [];

        if (!$this->tableHasColumn($this->table, 'start_at')) {
            $columnsToAdd['start_at'] = [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'start_date',
            ];
        }

        if (!$this->tableHasColumn($this->table, 'end_at')) {
            $columnsToAdd['end_at'] = [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'end_date',
            ];
        }

        if (!empty($columnsToAdd)) {
            $this->dbforge->add_column($this->table, $columnsToAdd);
            unset($this->tableColumns[$this->table]);
        }
    }

    private function ensurePlanCatalogTable()
    {
        if (!$this->db->table_exists($this->catalogTable)) {
            $fields = [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'code' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                ],
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'duration_days' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0,
                ],
                'price' => [
                    'type' => 'DECIMAL',
                    'constraint' => '10,2',
                    'default' => 0.00,
                ],
                'tag' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => true,
                ],
                'accent' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'default' => 'monthly',
                ],
                'is_trial' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 0,
                ],
                'is_active' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 1,
                ],
                'features_json' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'sort_order' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ];

            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', true);
            $this->dbforge->add_key('code');
            $this->dbforge->create_table($this->catalogTable, true);
        }

        // $this->seedPlanCatalog();
    }

    private function ensurePaymentTable()
    {
        if ($this->db->table_exists($this->paymentTable)) {
            return;
        }

        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'plan_code' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'plan_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'currency' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'default' => 'INR',
            ],
            'receipt' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'razorpay_order_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'razorpay_payment_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'razorpay_signature' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'created',
            ],
            'gateway_response' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('user_id');
        $this->dbforge->add_key('plan_code');
        $this->dbforge->add_key('razorpay_order_id');
        $this->dbforge->create_table($this->paymentTable, true);
    }

    private function tableHasColumn($table, $column)
    {
        $table = (string) $table;
        $column = strtolower((string) $column);

        if (!isset($this->tableColumns[$table])) {
            $this->tableColumns[$table] = [];

            foreach ($this->db->field_data($table) as $field) {
                $this->tableColumns[$table][strtolower((string) $field->name)] = true;
            }
        }

        return isset($this->tableColumns[$table][$column]);
    }

    private function getDefaultPlanCatalog()
    {
        return [
            'trial' => [
                'code' => 'trial',
                'name' => '1 Month Free Trial',
                'duration_days' => 30,
                'price' => 0,
                'tag' => 'Starter',
                'accent' => 'trial',
                'is_trial' => 1,
                'is_active' => 1,
                'features' => [
                    'Full dashboard access',
                    'Complaint and customer management',
                    'AMC, orders and catalog modules',
                    'No payment needed for 30 days',
                ],
                'sort_order' => 1,
            ],
            'monthly' => [
                'code' => 'monthly',
                'name' => '1 Month Plan',
                'duration_days' => 30,
                'price' => 299,
                'tag' => 'Popular',
                'accent' => 'monthly',
                'is_trial' => 0,
                'is_active' => 1,
                'features' => [
                    '30 days full access',
                    'Unlimited daily admin usage',
                    'Manage complaints, AMC and sales',
                    'Best for trying the business workflow',
                ],
                'sort_order' => 2,
            ],
            'half_yearly' => [
                'code' => 'half_yearly',
                'name' => '6 Month Plan',
                'duration_days' => 180,
                'price' => 1299,
                'tag' => 'Best Value',
                'accent' => 'half-yearly',
                'is_trial' => 0,
                'is_active' => 1,
                'features' => [
                    '180 days full access',
                    'Longer uninterrupted store usage',
                    'Ideal for regular service businesses',
                    'Lower cost than monthly renewals',
                ],
                'sort_order' => 3,
            ],
            'yearly' => [
                'code' => 'yearly',
                'name' => '12 Month Plan',
                'duration_days' => 365,
                'price' => 2499,
                'tag' => 'Annual',
                'accent' => 'yearly',
                'is_trial' => 0,
                'is_active' => 1,
                'features' => [
                    '365 days full access',
                    'Best yearly value',
                    'Peace of mind for the whole year',
                    'Great for stable long-term use',
                ],
                'sort_order' => 4,
            ],
        ];
    }

    private function seedPlanCatalog()
    {
        $defaults = $this->getDefaultPlanCatalog();
        $now = date('Y-m-d H:i:s');

        foreach ($defaults as $plan) {
            $existing = $this->db
                ->where('code', $plan['code'])
                ->get($this->catalogTable)
                ->row_array();

            if ($existing) {
                continue;
            }

            $insertData = [
                'code' => $plan['code'],
                'name' => $plan['name'],
                'duration_days' => (int) $plan['duration_days'],
                'price' => (float) $plan['price'],
                'tag' => $plan['tag'],
                'accent' => $plan['accent'],
                'is_trial' => (int) $plan['is_trial'],
                'is_active' => (int) $plan['is_active'],
                'sort_order' => (int) $plan['sort_order'],
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if ($this->tableHasColumn($this->catalogTable, 'features_json')) {
                $insertData['features_json'] = json_encode($plan['features']);
            }

            $this->db->insert($this->catalogTable, $insertData);
        }
    }

    private function buildDurationLabel($days)
    {
        $days = (int) $days;

        if ($days === 30) {
            return '1 month';
        }

        if ($days === 180) {
            return '6 months';
        }

        if ($days === 365) {
            return '12 months';
        }

        if ($days % 30 === 0 && $days >= 30) {
            $months = (int) ($days / 30);
            return $months . ' month' . ($months === 1 ? '' : 's');
        }

        return $days . ' day' . ($days === 1 ? '' : 's');
    }

    private function buildPriceLabel($price, $isTrial)
    {
        if ((int) $isTrial === 1 || (float) $price <= 0) {
            return 'Free';
        }

        return 'Rs ' . number_format((float) $price, 0);
    }

    private function hydrateCatalogRow(array $row)
    {
        $features = json_decode((string) ($row['features_json'] ?? '[]'), true);

        if (!is_array($features)) {
            $features = [];
        }

        $features = array_values(array_filter(array_map('trim', $features), static function ($feature) {
            return $feature !== '';
        }));

        if (empty($features)) {
            $defaults = $this->getDefaultPlanCatalog();
            $code = (string) ($row['code'] ?? '');
            $features = isset($defaults[$code]['features']) ? $defaults[$code]['features'] : [];
        }

        return [
            'id' => (int) ($row['id'] ?? 0),
            'code' => (string) ($row['code'] ?? ''),
            'name' => (string) ($row['name'] ?? ''),
            'duration_days' => (int) ($row['duration_days'] ?? 0),
            'duration_label' => $this->buildDurationLabel((int) ($row['duration_days'] ?? 0)),
            'price' => (float) ($row['price'] ?? 0),
            'price_label' => $this->buildPriceLabel((float) ($row['price'] ?? 0), (int) ($row['is_trial'] ?? 0)),
            'tag' => (string) ($row['tag'] ?? ''),
            'accent' => (string) ($row['accent'] ?? 'monthly'),
            'is_trial' => (int) ($row['is_trial'] ?? 0) === 1,
            'is_active' => (int) ($row['is_active'] ?? 1) === 1,
            'features' => $features,
            'sort_order' => (int) ($row['sort_order'] ?? 0),
        ];
    }

    public function get_plan_catalog()
    {
        $rows = $this->db
            ->order_by('sort_order', 'ASC')
            ->order_by('id', 'ASC')
            ->get($this->catalogTable)
            ->result_array();

        if (empty($rows)) {
            $this->seedPlanCatalog();
            $rows = $this->db
                ->order_by('sort_order', 'ASC')
                ->order_by('id', 'ASC')
                ->get($this->catalogTable)
                ->result_array();
        }

        $catalog = [];

        foreach ($rows as $row) {
            $plan = $this->hydrateCatalogRow($row);
            $catalog[$plan['code']] = $plan;
        }

        return $catalog;
    }

    public function get_plan_catalog_for_manage()
    {
        return array_values($this->get_plan_catalog());
    }

    public function update_plan_catalog(array $plans)
    {
        if (empty($plans)) {
            return false;
        }

        $existingCatalog = $this->get_plan_catalog();
        $allowedAccents = ['trial', 'monthly', 'half-yearly', 'yearly'];
        $now = date('Y-m-d H:i:s');

        $this->db->trans_start();

        foreach ($plans as $index => $planInput) {
            $code = trim((string) ($planInput['code'] ?? ''));

            if ($code === '' || !isset($existingCatalog[$code])) {
                continue;
            }

            $existing = $existingCatalog[$code];
            $name = trim((string) ($planInput['name'] ?? $existing['name']));
            $durationDays = max(1, (int) ($planInput['duration_days'] ?? $existing['duration_days']));
            $price = max(0, (float) ($planInput['price'] ?? $existing['price']));
            $tag = trim((string) ($planInput['tag'] ?? $existing['tag']));
            $accent = trim((string) ($planInput['accent'] ?? $existing['accent']));
            $isActive = isset($planInput['is_active']) ? (int) $planInput['is_active'] : ($existing['is_active'] ? 1 : 0);
            $featuresRaw = $planInput['features'] ?? $existing['features'];
            $features = is_array($featuresRaw) ? $featuresRaw : preg_split('/\r\n|\r|\n/', (string) $featuresRaw);
            $features = array_values(array_filter(array_map('trim', $features), static function ($feature) {
                return $feature !== '';
            }));

            if ($name === '') {
                $name = $existing['name'];
            }

            if (!in_array($accent, $allowedAccents, true)) {
                $accent = $existing['accent'];
            }

            if ((int) $existing['is_trial'] === 1) {
                $price = 0;
                $isActive = 1;
            }

            if (empty($features)) {
                $features = $existing['features'];
            }

            $updateData = [
                'name' => $name,
                'duration_days' => $durationDays,
                'price' => $price,
                'tag' => $tag,
                'accent' => $accent,
                'is_active' => $isActive,
                'sort_order' => $index + 1,
                'updated_at' => $now,
            ];

            if ($this->tableHasColumn($this->catalogTable, 'features_json')) {
                $updateData['features_json'] = json_encode($features);
            }

            $this->db
                ->where('code', $code)
                ->update($this->catalogTable, $updateData);
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function get_latest_subscription($userId)
    {
        return $this->db
            ->from($this->table)
            ->where('user_id', (int) $userId)
            ->order_by('id', 'DESC')
            ->get()
            ->row();
    }

    public function get_latest_paid_subscription($userId)
    {
        $subscription = $this->db
            ->from($this->table)
            ->where('user_id', (int) $userId)
            ->where('is_trial', 0)
            ->order_by('id', 'DESC')
            ->get()
            ->row();

        if (!$subscription) {
            return null;
        }

        return $this->sync_subscription_expiry($subscription);
    }

    public function has_used_trial($userId)
    {
        return $this->db
            ->from($this->table)
            ->where('user_id', (int) $userId)
            ->where('is_trial', 1)
            ->count_all_results() > 0;
    }

    public function create_free_trial($userId)
    {
        $catalog = $this->get_plan_catalog();
        // echo "<pre>";
        // print_r($catalog);
        // die;
        // echo "cat end";
        $trial = $catalog['trial'];
        // echo "<pre>";
        // print_r($trial);
        // die;
        $now = date('Y-m-d H:i:s');
        $user = $this->db
            ->select('created_on')
            ->where('id', (int) $userId)
            ->get('users')
            ->row();

        $startAt = $now;

        if (!empty($user->created_on) && $user->created_on !== '0000-00-00 00:00:00') {
            $startAt = date('Y-m-d H:i:s', strtotime((string) $user->created_on));
        }

        $endAt = $this->calculatePlanEndAt($startAt, (int) $trial['duration_days'], (string) $trial['code']);
        $status = $this->isEndAtExpired($endAt) ? 'expired' : 'trial';

        $data = [
            'user_id' => (int) $userId,
            'plan_code' => $trial['code'],
            'plan_name' => $trial['name'],
            'duration_days' => (int) $trial['duration_days'],
            'amount' => 0,
            'is_trial' => 1,
            'status' => $status,
            'start_date' => date('Y-m-d', strtotime($startAt)),
            'start_at' => $startAt,
            'end_date' => date('Y-m-d', strtotime($endAt)),
            'end_at' => $endAt,
            'created_at' => $now,
            'updated_at' => $now,
        ];
        // echo <pre>;
        // print_r();
        // die;

        $this->db->insert($this->table, $data);

        return $this->get_latest_subscription($userId);
    }

    public function get_or_create_subscription($userId)
    {
        $subscription = $this->get_latest_subscription($userId);

        if ($subscription) {
            return $this->sync_subscription_state($subscription, $userId);
        }

        return $this->create_free_trial($userId);
    }

    private function sync_subscription_state($subscription, $userId)
    {
        if (!$subscription) {
            return $subscription;
        }

        if ((int) $subscription->is_trial === 1) {
            $subscription = $this->sync_trial_dates($subscription, $userId);
        }

        return $this->sync_subscription_expiry($subscription);
    }

    private function sync_trial_dates($subscription, $userId)
    {
        if (!$subscription || (int) $subscription->is_trial !== 1) {
            return $subscription;
        }

        // ✅ If end_at is already set, TRUST IT - don't overwrite
        if (
            !empty($subscription->end_at) &&
            $subscription->end_at !== '0000-00-00 00:00:00'
        ) {
            return $subscription; // ← just return, don't call sync_expiry here
        }

        $user = $this->db
            ->select('created_on')
            ->where('id', (int) $userId)
            ->get('users')
            ->row();

        if (empty($user->created_on) || $user->created_on === '0000-00-00 00:00:00') {
            return $subscription;
        }

        $createdTimestamp = strtotime((string) $user->created_on);

        if ($createdTimestamp === false) {
            return $subscription;
        }

        $expectedStartAt   = date('Y-m-d H:i:s', $createdTimestamp);
        $expectedEndAt     = $this->calculatePlanEndAt(
            $expectedStartAt,
            (int) ($subscription->duration_days ?? 30),
            (string) ($subscription->plan_code ?? 'trial')
        );
        $expectedStartDate = date('Y-m-d', strtotime($expectedStartAt));
        $expectedEndDate   = date('Y-m-d', strtotime($expectedEndAt));
        $expectedStatus    = $this->isEndAtExpired($expectedEndAt) ? 'expired' : 'trial';

        $currentStartAt  = $this->getSubscriptionStartAt($subscription);
        $currentEndAt    = $this->getSubscriptionEndAt($subscription);
        $currentStatus   = (string) ($subscription->status ?? '');

        if (
            $currentStartAt  === $expectedStartAt &&
            $currentEndAt    === $expectedEndAt &&
            $currentStatus   === $expectedStatus
        ) {
            return $subscription;
        }

        $this->db
            ->where('id', (int) $subscription->id)
            ->update($this->table, [
                'start_date' => $expectedStartDate,
                'start_at'   => $expectedStartAt,
                'end_date'   => $expectedEndDate,
                'end_at'     => $expectedEndAt,
                'status'     => $expectedStatus,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return $this->get_latest_subscription($userId);
    }

    private function sync_subscription_expiry($subscription)
    {
        if (!$subscription || (string) ($subscription->status ?? '') === 'completed') {
            return $subscription;
        }

        $startAt = $this->getSubscriptionStartAt($subscription);
        $endAt   = $this->getSubscriptionEndAt($subscription);

        if ($startAt === null) {
            return $subscription;
        }

        // ✅ ONLY recalculate endAt if BOTH end_at AND end_date are missing

        if ($endAt === null) {
            // ✅ Use stored end_date before recalculating from duration
            if (!empty($subscription->end_date) && $subscription->end_date !== '0000-00-00') {
                $endAt = date('Y-m-d', strtotime((string) $subscription->end_date)) . ' 23:59:59';
            } else {
                $endAt = $this->calculatePlanEndAt(
                    $startAt,
                    (int) ($subscription->duration_days ?? 0),
                    (string) ($subscription->plan_code ?? '')
                );
            }
        }

        if ($endAt === null) {
            return $subscription;
        }

        $expectedStatus = $this->isEndAtExpired($endAt)
            ? 'expired'
            : ((int) ($subscription->is_trial ?? 0) === 1 ? 'trial' : 'active');

        $currentStartDate = !empty($subscription->start_date) ? date('Y-m-d', strtotime((string) $subscription->start_date)) : '';
        $currentEndDate = !empty($subscription->end_date) ? date('Y-m-d', strtotime((string) $subscription->end_date)) : '';
        $expectedStartDate = date('Y-m-d', strtotime($startAt));
        $expectedEndDate = date('Y-m-d', strtotime($endAt));
        $currentStartAt = $this->getSubscriptionStartAt($subscription);
        $currentEndAt = $this->getSubscriptionEndAt($subscription);
        $currentStatus = (string) ($subscription->status ?? '');

        if (
            $currentStartDate === $expectedStartDate &&
            $currentEndDate === $expectedEndDate &&
            $currentStartAt === $startAt &&
            $currentEndAt === $endAt &&
            $currentStatus === $expectedStatus
        ) {
            return $subscription;
        }

        $this->db
            ->where('id', (int) $subscription->id)
            ->update($this->table, [
                'start_date' => $expectedStartDate,
                'start_at' => $startAt,
                'end_date' => $expectedEndDate,
                'end_at' => $endAt,
                'status' => $expectedStatus,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return $this->db
            ->where('id', (int) $subscription->id)
            ->get($this->table)
            ->row();
    }

    public function get_active_paid_subscription($userId)
    {
        $subscription = $this->get_or_create_subscription($userId);

        if (
            !$subscription ||
            (int) $subscription->is_trial === 1
        ) {
            return null;
        }

        $endAt = $this->getSubscriptionEndAt($subscription);

        if ($endAt === null || $this->isEndAtExpired($endAt)) {
            return null;
        }

        return $subscription;
    }

    public function get_plan_change_block_message($userId)
    {
        $subscription = $this->get_active_paid_subscription($userId);

        if (!$subscription) {
            return '';
        }

        $endDate = $this->formatDateTimeLabel($this->getSubscriptionEndAt($subscription));

        return $subscription->plan_name . ' is already active until ' . $endDate . '. You can purchase another plan after it expires.';
    }

    public function can_activate_plan($userId)
    {
        return $this->get_active_paid_subscription($userId) === null;
    }

    public function get_checkout_plan($planCode)
    {
        $planCode = trim((string) $planCode);
        $plans = $this->get_plan_catalog();

        if (
            $planCode === '' ||
            !isset($plans[$planCode]) ||
            !empty($plans[$planCode]['is_trial']) ||
            empty($plans[$planCode]['is_active'])
        ) {
            return null;
        }

        return $plans[$planCode];
    }

    public function create_payment_order($userId, array $plan, array $razorpayOrder)
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            'user_id' => (int) $userId,
            'plan_code' => (string) ($plan['code'] ?? ''),
            'plan_name' => (string) ($plan['name'] ?? ''),
            'amount' => (float) ($plan['price'] ?? 0),
            'currency' => (string) ($razorpayOrder['currency'] ?? 'INR'),
            'receipt' => (string) ($razorpayOrder['receipt'] ?? ''),
            'razorpay_order_id' => (string) ($razorpayOrder['id'] ?? ''),
            'status' => 'created',
            'gateway_response' => json_encode($razorpayOrder),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $this->db->insert($this->paymentTable, $data);

        return $this->db->insert_id() > 0
            ? $this->db->where('id', (int) $this->db->insert_id())->get($this->paymentTable)->row()
            : null;
    }

    public function get_payment_order($userId, $razorpayOrderId)
    {
        return $this->db
            ->from($this->paymentTable)
            ->where('user_id', (int) $userId)
            ->where('razorpay_order_id', (string) $razorpayOrderId)
            ->order_by('id', 'DESC')
            ->get()
            ->row();
    }

    public function mark_payment_failed($paymentOrderId, array $payload = [])
    {
        $this->db
            ->where('id', (int) $paymentOrderId)
            ->update($this->paymentTable, [
                'status' => 'failed',
                'gateway_response' => json_encode($payload),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return $this->db->affected_rows() >= 0;
    }

    public function complete_payment_and_activate_plan($userId, $paymentOrderId, array $paymentPayload)
    {
        $paymentOrder = $this->db
            ->from($this->paymentTable)
            ->where('id', (int) $paymentOrderId)
            ->where('user_id', (int) $userId)
            ->get()
            ->row();

        if (!$paymentOrder || $paymentOrder->status === 'paid') {
            return false;
        }

        $plan = $this->get_checkout_plan((string) $paymentOrder->plan_code);

        if (!$plan) {
            return false;
        }

        if (!$this->can_activate_plan($userId)) {
            return false;
        }

        $now = date('Y-m-d H:i:s');
        $startAt = $now;
        $endAt = $this->calculatePlanEndAt($startAt, (int) $plan['duration_days'], (string) $plan['code']);

        $this->db->trans_start();

        $this->db
            ->where('id', (int) $paymentOrder->id)
            ->update($this->paymentTable, [
                'razorpay_payment_id' => (string) ($paymentPayload['razorpay_payment_id'] ?? ''),
                'razorpay_signature' => (string) ($paymentPayload['razorpay_signature'] ?? ''),
                'status' => 'paid',
                'gateway_response' => json_encode($paymentPayload),
                'updated_at' => $now,
            ]);

        $this->db
            ->where('user_id', (int) $userId)
            ->where_in('status', ['active', 'trial'])
            ->update($this->table, [
                'status' => 'completed',
                'updated_at' => $now,
            ]);

        $this->db->insert($this->table, [
            'user_id' => (int) $userId,
            'plan_code' => $plan['code'],
            'plan_name' => $plan['name'],
            'duration_days' => (int) $plan['duration_days'],
            'amount' => (float) $plan['price'],
            'is_trial' => 0,
            'status' => 'active',
            'start_date' => date('Y-m-d', strtotime($startAt)),
            'start_at' => $startAt,
            'end_date' => date('Y-m-d', strtotime($endAt)),
            'end_at' => $endAt,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function activate_plan($userId, $planCode)
    {
        $plans = $this->get_plan_catalog();

        if (
            !isset($plans[$planCode]) ||
            !empty($plans[$planCode]['is_trial']) ||
            empty($plans[$planCode]['is_active'])
        ) {
            return false;
        }

        if (!$this->can_activate_plan($userId)) {
            return false;
        }

        $plan = $plans[$planCode];
        $now = date('Y-m-d H:i:s');
        $startAt = $now;
        $endAt = $this->calculatePlanEndAt($startAt, (int) $plan['duration_days'], (string) $plan['code']);

        $this->db
            ->where('user_id', (int) $userId)
            ->where_in('status', ['active', 'trial'])
            ->update($this->table, [
                'status' => 'completed',
                'updated_at' => $now,
            ]);

        $insertData = [
            'user_id' => (int) $userId,
            'plan_code' => $plan['code'],
            'plan_name' => $plan['name'],
            'duration_days' => (int) $plan['duration_days'],
            'amount' => (float) $plan['price'],
            'is_trial' => 0,
            'status' => 'active',
            'start_date' => date('Y-m-d', strtotime($startAt)),
            'start_at' => $startAt,
            'end_date' => date('Y-m-d', strtotime($endAt)),
            'end_at' => $endAt,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $this->db->insert($this->table, $insertData);

        return $this->db->insert_id() > 0;
    }

    public function save_plan($userId, array $payload)
    {
        $userId = (int) $userId;
        $planCode = trim((string) ($payload['plan'] ?? $payload['plan_code'] ?? ''));

        if ($planCode !== '') {
            $plans = $this->get_plan_catalog();

            if (isset($plans[$planCode]) && empty($plans[$planCode]['is_trial'])) {
                return $this->activate_plan($userId, $planCode)
                    ? $this->get_latest_subscription($userId)
                    : false;
            }

            return false;
        }

        return false;
    }

    public function get_plan_summary($userId)
    {
        $subscription = $this->get_or_create_subscription($userId);

        if (!$subscription) {
            return null;
        }

        $nowTimestamp = time();
        $startAt = $this->getSubscriptionStartAt($subscription);
        $endAt = $this->getSubscriptionEndAt($subscription);
        $startTimestamp = $startAt !== null ? strtotime($startAt) : null;
        $endTimestamp = $endAt !== null ? strtotime($endAt) : null;
        $isExpired = $endTimestamp !== null ? ($nowTimestamp >= $endTimestamp) : false;
        $daysLeft = 0;

        if (!$isExpired && $endTimestamp !== null) {
            $secondsLeft = max(0, $endTimestamp - $nowTimestamp);
            $daysLeft = $secondsLeft > 0 ? (int) ceil($secondsLeft / 86400) : 0;
        }

        $isTrial = (int) $subscription->is_trial === 1;
        $statusLabel = $isExpired ? 'Expired' : ($isTrial ? 'Free Trial' : 'Active Plan');
        $latestPaidSubscription = $this->get_latest_paid_subscription($userId);
        $hasActivePaidPlan = !$isTrial && !$isExpired;
        $detailSubscription = $hasActivePaidPlan ? $subscription : $latestPaidSubscription;
        $detailStartAt = $this->getSubscriptionStartAt($detailSubscription);
        $detailEndAt = $this->getSubscriptionEndAt($detailSubscription);
        $detailStartDate = !empty($detailStartAt) ? strtotime((string) $detailStartAt) : null;
        $detailEndDate = !empty($detailEndAt) ? strtotime((string) $detailEndAt) : null;
        $showExpiryWarning = !$isExpired && $daysLeft > 0 && $daysLeft <= 7;

        return [
            'subscription' => $subscription,
            'latest_paid_subscription' => $latestPaidSubscription,
            'is_trial' => $isTrial,
            'is_expired' => $isExpired,
            'is_last_day' => !$isExpired && $daysLeft === 1,
            'days_left' => max(0, $daysLeft),
            'has_active_paid_plan' => $hasActivePaidPlan,
            'purchase_status' => $hasActivePaidPlan ? 'Paid' : 'Unpaid',
            'status_label' => $statusLabel,
            'plan_name' => (string) $subscription->plan_name,
            'start_date' => $startTimestamp ? $this->formatDateTimeLabel($startAt) : '-',
            'end_date' => $endTimestamp ? $this->formatDateTimeLabel($endAt) : '-',
            'start_at' => $startAt,
            'end_at' => $endAt,
            'detail_plan_label' => $hasActivePaidPlan ? 'Current Plan' : 'Previous Plan',
            'detail_plan_name' => !empty($detailSubscription->plan_name) ? (string) $detailSubscription->plan_name : 'No Paid Plan',
            'detail_start_date' => $detailStartDate ? $this->formatDateTimeLabel($detailStartAt) : '-',
            'detail_end_date' => $detailEndDate ? $this->formatDateTimeLabel($detailEndAt) : '-',
            'amount' => isset($subscription->amount) ? (float) $subscription->amount : 0,
            'message' => $this->buildStatusMessage($subscription, $isExpired, $daysLeft),
            'trial_used' => $this->has_used_trial($userId),
            'can_purchase_plan' => $this->can_activate_plan($userId),
            'purchase_locked_message' => $this->get_plan_change_block_message($userId),
            'show_expiry_warning' => $showExpiryWarning,
            'warning_days_left' => $showExpiryWarning ? $daysLeft : 0,
            'warning_message' => $showExpiryWarning ? $this->buildExpiryWarningMessage($subscription, $daysLeft, $endAt) : '',
        ];
    }

    private function buildStatusMessage($subscription, $isExpired, $daysLeft)
    {
        $planName = (string) $subscription->plan_name;
        $endDate = $this->formatDateTimeLabel($this->getSubscriptionEndAt($subscription));
        $isTrial = (int) $subscription->is_trial === 1;

        if ($isExpired) {
            return $isTrial
                ? 'Your free trial expired on ' . $endDate . '. Please choose a paid plan to continue smoothly.'
                : 'Your ' . $planName . ' expired on ' . $endDate . '. Please renew your plan.';
        }

        if ($isTrial && $daysLeft === 1) {
            return 'Today is the last day of your free trial. Choose a paid plan to avoid interruption.';
        }

        if ($isTrial) {
            return 'Your free trial is active. ' . $daysLeft . ' day' . ($daysLeft === 1 ? '' : 's') . ' left.';
        }

        return 'Your ' . $planName . ' is active until ' . $endDate . '.';
    }

    private function buildExpiryWarningMessage($subscription, $daysLeft, $endAt)
    {
        $planName = (string) ($subscription->plan_name ?? 'Plan');
        $expiryLabel = $this->formatDateTimeLabel($endAt);

        return $planName . ' ends in ' . (int) $daysLeft . ' day' . ((int) $daysLeft === 1 ? '' : 's') . ' on ' . $expiryLabel . '.';
    }

    private function getSubscriptionStartAt($subscription)
    {
        if (!$subscription) {
            return null;
        }

        if (!empty($subscription->start_at) && $subscription->start_at !== '0000-00-00 00:00:00') {
            return date('Y-m-d H:i:s', strtotime((string) $subscription->start_at));
        }

        if (!empty($subscription->start_date) && $subscription->start_date !== '0000-00-00') {
            $startDate = date('Y-m-d', strtotime((string) $subscription->start_date));
            $createdAt = !empty($subscription->created_at) ? strtotime((string) $subscription->created_at) : false;

            if ($createdAt !== false && date('Y-m-d', $createdAt) === $startDate) {
                return date('Y-m-d H:i:s', $createdAt);
            }

            return $startDate . ' 00:00:00';
        }

        return null;
    }

    private function getSubscriptionEndAt($subscription)
    {
        if (!$subscription) {
            return null;
        }

        if (!empty($subscription->end_at) && $subscription->end_at !== '0000-00-00 00:00:00') {
            return date('Y-m-d H:i:s', strtotime((string) $subscription->end_at));
        }

        if (!empty($subscription->end_date) && $subscription->end_date !== '0000-00-00') {
            return date('Y-m-d', strtotime((string) $subscription->end_date)) . ' 23:59:59';
        }

        return null;
    }

    private function calculatePlanEndAt($startAt, $durationDays, $planCode = '')
    {
        $startAt = trim((string) $startAt);

        if ($startAt === '') {
            return null;
        }

        try {
            $date = new DateTime($startAt);
            $planCode = strtolower(trim((string) $planCode));

            if ($planCode === 'trial' || $planCode === 'monthly') {
                $date->add(new DateInterval('P1M'));
            } elseif ($planCode === 'half_yearly') {
                $date->add(new DateInterval('P6M'));
            } elseif ($planCode === 'yearly') {
                $date->add(new DateInterval('P1Y'));
            } else {
                $days = max(1, (int) $durationDays);
                $date->add(new DateInterval('P' . $days . 'D'));
            }

            return $date->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            return null;
        }
    }

    private function isEndAtExpired($endAt)
    {
        $endTimestamp = !empty($endAt) ? strtotime((string) $endAt) : false;

        if ($endTimestamp === false) {
            return false;
        }

        return time() >= $endTimestamp;
    }

    private function formatDateTimeLabel($dateTime)
    {
        if (empty($dateTime)) {
            return '';
        }

        $timestamp = strtotime((string) $dateTime);

        if ($timestamp === false) {
            return '';
        }

        return date('d M Y, h:i A', $timestamp);
    }

    public function get_plan_status($user_id)
    {
        $plan = $this->get_latest_subscription($user_id);

        if (!$plan) return null;

        // 🔥 IMPORTANT: Sync first
        $plan = $this->sync_subscription_state($plan, $user_id);

        $today = strtotime(date('Y-m-d'));
        $end   = strtotime(date('Y-m-d', strtotime($plan->end_at)));

        $days_left = (int) floor(($end - $today) / 86400);

        return [
            'plan'        => $plan,
            'days_left'   => $days_left,
            'is_expiring' => $days_left <= 7 && $days_left >= 0,
            'is_expired'  => $days_left < 0
        ];
    }
}
