<div class="page-wrapper">
    <div class="page-content">

        <h3>Edit Order</h3>

        <form method="post" action="<?= base_url('index.php/admin/orders/update_order') ?>">

            <input type="hidden" name="id" value="<?= $order->id ?>">

            <div class="mb-3">
                <label>Product Name</label>
                <input type="text" name="product_name" class="form-control" value="<?= $order->product_name ?>"
                    required>
            </div>

            <div class="mb-3">
                <label>Model Number</label>
                <input type="text" name="modal_numb" class="form-control" value="<?= $order->product_modal ?>">
            </div>

            <div class="mb-3">
                <label>Purchase Date</label>
                <input type="date" name="purchasedate" class="form-control" value="<?= $order->date_of_purchase ?>">
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control" value="<?= $order->price ?>">
            </div>

            <div class="mb-3">
                <label>Payment Type</label>
                <select name="customRadio" class="form-control">
                    <option value="cash" <?= $order->payment_type == 'cash' ? 'selected' : '' ?>>Cash</option>
                    <option value="online" <?= $order->payment_type == 'online' ? 'selected' : '' ?>>EMI</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Service Interval</label>
                <input type="text" name="service_interval" class="form-control" value="<?= $order->service_interval ?>">
            </div>

            <div class="mb-3">
                <label>Total Services</label>
                <input type="number" name="total_services" class="form-control" value="<?= $order->total_services ?>">
            </div>

            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>

    </div>
</div>