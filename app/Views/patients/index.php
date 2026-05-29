<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patients</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            padding: 40px;
        }

        .container {
            background: white;
            max-width: 1100px;
            margin: auto;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }

        h1 {
            margin-bottom: 10px;
            color: #0f172a;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-box input {
            padding: 10px;
            width: 250px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background: #f1f5f9;
            cursor: pointer;
        }

        th a {
            text-decoration: none;
            color: #0f172a;
        }

        tr:hover {
            background: #f8fafc;
        }

        .badge {
            background: #e2e8f0;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
        }

        .pagination {
            margin-top: 20px;
        }

        .logout {
            background: #ef4444;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
        }

        .logout:hover {
            background: #dc2626;
        }

        .total {
            color: #64748b;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="top-bar">
        <div>
            <h1>Patients</h1>
            <div class="total">Total records: <?= $total ?></div>
        </div>

        <div>
            <a class="logout" href="<?= site_url('logout') ?>">Logout</a>
        </div>
    </div>

    <form method="get" class="search-box">
        <input type="text" name="search" placeholder="Search patients..."
               value="<?= esc($search ?? '') ?>">
    </form>

    <?php
    function sortLink($col, $label, $sort, $dir) {
        $newDir = ($sort === $col && $dir === 'asc') ? 'desc' : 'asc';
        return "<a href='?sort=$col&dir=$newDir'>$label</a>";
    }
    ?>

    <table>
        <thead>
            <tr>
                <th><?= sortLink('first_name','First Name',$sort,$dir) ?></th>
                <th><?= sortLink('last_name','Last Name',$sort,$dir) ?></th>
                <th><?= sortLink('birth_date','Birth Date',$sort,$dir) ?></th>
                <th><?= sortLink('cnp','CNP',$sort,$dir) ?></th>
                <th><?= sortLink('patient_number','Patient No',$sort,$dir) ?></th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($patients as $p): ?>
            <tr>
                <td><?= esc($p['first_name']) ?></td>
                <td><?= esc($p['last_name']) ?></td>
                <td><?= esc($p['birth_date']) ?></td>
                <td><span class="badge"><?= esc($p['cnp']) ?></span></td>
                <td><?= esc($p['patient_number']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?= $pager->links() ?>
    </div>

</div>

</body>
</html>