<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --success: #059669;
            --warning: #d97706;
            --danger: #dc2626;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--gray-50);
            color: var(--gray-800);
            min-height: 100vh;
            font-size: 14px;
        }

        /* Header */
        .page-header {
            background: #fff;
            border-bottom: 1px solid var(--gray-200);
            padding: 1.25rem 0;
        }

        .page-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .breadcrumb {
            margin: 0;
            padding: 0;
            background: none;
            font-size: 0.8rem;
        }

        .breadcrumb-item a {
            color: var(--gray-500);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: var(--primary);
        }

        .breadcrumb-item.active {
            color: var(--gray-700);
        }

        /* Main Content */
        .main-content {
            padding: 1.5rem 0;
        }

        /* Stat Cards */
        .stat-card {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 1.25rem;
        }

        .stat-card .stat-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .stat-card .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-top: 0.25rem;
        }

        .stat-card .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .stat-icon.blue { background: #dbeafe; color: #2563eb; }
        .stat-icon.green { background: #d1fae5; color: #059669; }
        .stat-icon.yellow { background: #fef3c7; color: #d97706; }
        .stat-icon.red { background: #fee2e2; color: #dc2626; }

        /* Table Card */
        .table-card {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            overflow: hidden;
        }

        .table-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .table-header h2 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
        }

        .table-header .count {
            background: var(--gray-100);
            color: var(--gray-600);
            font-size: 0.75rem;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        /* Search & Actions */
        .toolbar {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-input {
            padding: 0.5rem 0.75rem 0.5rem 2.25rem;
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            font-size: 0.875rem;
            width: 220px;
            background: #fff;
            transition: border-color 0.15s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-wrapper {
            position: relative;
        }

        .search-wrapper i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 0.875rem;
        }

        .btn {
            padding: 0.5rem 0.875rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            border: 1px solid var(--gray-300);
            background: #fff;
            color: var(--gray-700);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            transition: all 0.15s;
        }

        .btn:hover {
            background: var(--gray-50);
            border-color: var(--gray-400);
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        /* Filter Tabs */
        .filter-tabs {
            padding: 0 1.25rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            gap: 0;
        }

        .filter-tab {
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--gray-500);
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
            transition: all 0.15s;
        }

        .filter-tab:hover {
            color: var(--gray-700);
        }

        .filter-tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .filter-tab .tab-count {
            background: var(--gray-100);
            padding: 0.1rem 0.4rem;
            border-radius: 4px;
            font-size: 0.7rem;
            margin-left: 0.35rem;
        }

        .filter-tab.active .tab-count {
            background: #dbeafe;
            color: var(--primary);
        }

        /* Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead th {
            padding: 0.75rem 1rem;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-500);
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
            text-align: left;
            white-space: nowrap;
        }

        .data-table tbody td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid var(--gray-100);
            color: var(--gray-700);
            vertical-align: middle;
        }

        .data-table tbody tr:hover {
            background: var(--gray-50);
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Table Cells */
        .product-id {
            font-weight: 500;
            color: var(--gray-500);
            font-size: 0.8rem;
        }

        .brand-cell {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        .brand-logo {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.7rem;
            color: #fff;
            flex-shrink: 0;
        }

        .brand-name {
            font-weight: 500;
            color: var(--gray-800);
        }

        .model-text {
            color: var(--gray-600);
            font-family: 'SF Mono', 'Consolas', monospace;
            font-size: 0.8rem;
        }

        .product-name {
            font-weight: 500;
            color: var(--gray-800);
        }

        .product-sku {
            font-size: 0.75rem;
            color: var(--gray-400);
            margin-top: 0.125rem;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.25rem 0.625rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-badge.in-stock {
            background: #d1fae5;
            color: #065f46;
        }

        .status-badge.low-stock {
            background: #fef3c7;
            color: #92400e;
        }

        .status-badge.out-of-stock {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .in-stock .status-dot { background: #10b981; }
        .low-stock .status-dot { background: #f59e0b; }
        .out-of-stock .status-dot { background: #ef4444; }

        .price {
            font-weight: 600;
            color: var(--gray-900);
        }

        /* Actions */
        .action-btns {
            display: flex;
            gap: 0.25rem;
        }

        .action-btn {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-400);
            transition: all 0.15s;
        }

        .action-btn:hover {
            background: var(--gray-100);
            color: var(--gray-700);
        }

        .action-btn.edit:hover { color: var(--primary); }
        .action-btn.delete:hover { color: var(--danger); }

        /* Checkbox */
        .checkbox {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            border: 1.5px solid var(--gray-300);
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
        }

        .checkbox:checked {
            background: var(--primary);
            border-color: var(--primary);
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
        }

        .checkbox:hover {
            border-color: var(--primary);
        }

        /* Table Footer */
        .table-footer {
            padding: 0.875rem 1.25rem;
            border-top: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            background: #fff;
        }

        .table-info {
            font-size: 0.8rem;
            color: var(--gray-500);
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .page-btn {
            min-width: 32px;
            height: 32px;
            padding: 0 0.5rem;
            border-radius: 6px;
            border: 1px solid var(--gray-200);
            background: #fff;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--gray-600);
            transition: all 0.15s;
        }

        .page-btn:hover:not(:disabled) {
            border-color: var(--primary);
            color: var(--primary);
        }

        .page-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--gray-500);
        }

        .empty-state i {
            font-size: 2.5rem;
            color: var(--gray-300);
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .table-header { flex-direction: column; align-items: stretch; }
            .toolbar { flex-direction: column; }
            .search-input { width: 100%; }
            .data-table { display: block; overflow-x: auto; }
        }
    </style>
</head>

<body>
    <!-- Header -->
     <div class="page-wrapper">
    <div class="page-content">
    <div class="page-header">
        <div class="container">
            <nav class="breadcrumb mb-2">
                <a class="breadcrumb-item" href="#">Dashboard</a>
                <span class="breadcrumb-item active">Stock Management</span>
            </nav>
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <h1>Stock Management</h1>
                <div class="d-flex gap-2">
                    <button class="btn">
                        <i class="fas fa-download"></i> Export
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus" href="index.php/admin/stock/add"></i> Add Stock 
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">

            <?php
                $totalItems = count($stock);
                $totalQty = array_sum(array_map(fn($s) => $s->quantity, $stock));
                $totalValue = array_sum(array_map(fn($s) => $s->quantity * $s->price, $stock));
                $lowStockCount = count(array_filter($stock, fn($s) => $s->quantity > 0 && $s->quantity <= 10));
                $outOfStock = count(array_filter($stock, fn($s) => $s->quantity == 0));
                $inStockCount = count(array_filter($stock, fn($s) => $s->quantity > 10));
            ?>

            <!-- Stats -->
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="stat-label">Total Products</div>
                                <div class="stat-value"><?= number_format($totalItems) ?></div>
                            </div>
                            <div class="stat-icon blue">
                                <i class="fas fa-box"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="stat-label">Total Quantity</div>
                                <div class="stat-value"><?= number_format($totalQty) ?></div>
                            </div>
                            <div class="stat-icon green">
                                <i class="fas fa-cubes"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="stat-label">Inventory Value</div>
                                <div class="stat-value">$<?= number_format($totalValue, 0) ?></div>
                            </div>
                            <div class="stat-icon yellow">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="stat-label">Low Stock Alerts</div>
                                <div class="stat-value"><?= $lowStockCount + $outOfStock ?></div>
                            </div>
                            <div class="stat-icon red">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="table-card">
                <div class="table-header">
                    <h2>
                        Inventory
                        <span class="count"><?= $totalItems ?> items</span>
                    </h2>
                    <div class="toolbar">
                        <div class="search-wrapper">
                            <i class="fas fa-search"></i>
                            <input type="text" class="search-input" id="searchInput" placeholder="Search..." onkeyup="filterTable()">
                        </div>
                        <button class="btn" onclick="exportCSV()">
                            <i class="fas fa-file-export"></i> Export
                        </button>
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="filter-tabs">
                    <div class="filter-tab active" onclick="filterStock('all', this)">
                        All <span class="tab-count"><?= $totalItems ?></span>
                    </div>
                    <div class="filter-tab" onclick="filterStock('in-stock', this)">
                        In Stock <span class="tab-count"><?= $inStockCount ?></span>
                    </div>
                    <div class="filter-tab" onclick="filterStock('low-stock', this)">
                        Low Stock <span class="tab-count"><?= $lowStockCount ?></span>
                    </div>
                    <div class="filter-tab" onclick="filterStock('out-of-stock', this)">
                        Out of Stock <span class="tab-count"><?= $outOfStock ?></span>
                    </div>
                </div>

                <!-- Table -->
                <div style="overflow-x: auto;">
                    <table class="data-table" id="stockTable">
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <input type="checkbox" class="checkbox" id="selectAll" onclick="toggleSelectAll()">
                                </th>
                                <th>ID</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $colors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4', '#ec4899', '#14b8a6'];
                            $i = 0;
                            foreach ($stock as $s) {
                                $qty = $s->quantity;
                                if ($qty == 0) {
                                    $status = 'out-of-stock';
                                } elseif ($qty <= 10) {
                                    $status = 'low-stock';
                                } else {
                                    $status = 'in-stock';
                                }
                                $color = $colors[$i % count($colors)];
                                $initials = strtoupper(substr($s->brand_name, 0, 2));
                                $i++;
                            ?>
                            <tr data-status="<?= $status ?>">
                                <td><input type="checkbox" class="checkbox row-check"></td>
                                <td><span class="product-id"><?= str_pad($s->id, 4, '0', STR_PAD_LEFT) ?></span></td>
                                <td>
                                    <div class="brand-cell">
                                        <div class="brand-logo" style="background: <?= $color ?>;"><?= $initials ?></div>
                                        <span class="brand-name"><?= htmlspecialchars($s->brand_name) ?></span>
                                    </div>
                                </td>
                                <td><span class="model-text"><?= htmlspecialchars($s->model_number) ?></span></td>
                                <td>
                                    <div class="product-name"><?= htmlspecialchars($s->product_name) ?></div>
                                    <div class="product-sku">SKU: <?= htmlspecialchars($s->model_number) ?></div>
                                </td>
                                <td>
                                    <span class="status-badge <?= $status ?>">
                                        <span class="status-dot"></span>
                                        <?= number_format($qty) ?>
                                    </span>
                                </td>
                                <td><span class="price">$<?= number_format($s->price, 2) ?></span></td>
                                <td>
                                  <div class="action-btns">

    <a href="<?= site_url('admin/stock/view/'.$s->id) ?>" class="action-btn" title="View">
        <i class="fas fa-eye"></i>
    </a>

    <a href="<?= site_url('admin/stock/edit/'.$s->id) ?>" class="action-btn edit" title="Edit">
        <i class="fas fa-edit"></i>
    </a>

    <a href="<?= site_url('admin/stock/delete/'.$s->id) ?>" 
       class="action-btn delete"
       onclick="return confirm('Are you sure you want to delete this stock?')"
       title="Delete">
        <i class="fas fa-trash"></i>
    </a>

</div>
                                </td>
                            </tr>
                            <?php } ?>

                            <?php if (empty($stock)) { ?>
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="fas fa-box-open"></i>
                                        <h5>No items found</h5>
                                        <p>Add your first inventory item to get started.</p>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Footer -->
                <div class="table-footer">
                    <div class="table-info">
                        Showing <strong>1-<?= min($totalItems, 10) ?></strong> of <strong><?= $totalItems ?></strong> items
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <select class="btn" style="padding: 0.375rem 0.75rem;">
                            <option>10 per page</option>
                            <option>25 per page</option>
                            <option>50 per page</option>
                        </select>
                        <div class="pagination">
                            <button class="page-btn" disabled><i class="fas fa-chevron-left"></i></button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>     </div>
    </div>

    <script>
        function filterTable() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('#stockTable tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(input) ? '' : 'none';
            });
        }

        function filterStock(status, tab) {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            
            document.querySelectorAll('#stockTable tbody tr').forEach(row => {
                row.style.display = (status === 'all' || row.dataset.status === status) ? '' : 'none';
            });
        }

        function toggleSelectAll() {
            const checked = document.getElementById('selectAll').checked;
            document.querySelectorAll('.row-check').forEach(cb => cb.checked = checked);
        }

        function exportCSV() {
            const table = document.getElementById('stockTable');
            let csv = [];
            const headers = [];
            table.querySelectorAll('thead th').forEach((th, i) => {
                if (i > 0 && i < 7) headers.push(th.textContent.trim());
            });
            csv.push(headers.join(','));

            table.querySelectorAll('tbody tr').forEach(row => {
                if (row.style.display === 'none') return;
                const cols = [];
                row.querySelectorAll('td').forEach((td, i) => {
                    if (i > 0 && i < 7) cols.push('"' + td.textContent.trim().replace(/"/g, '""') + '"');
                });
                if (cols.length) csv.push(cols.join(','));
            });

            const blob = new Blob([csv.join('\n')], { type: 'text/csv' });
            const a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = 'stock_export.csv';
            a.click();
        }
    </script>
</body>
</html>