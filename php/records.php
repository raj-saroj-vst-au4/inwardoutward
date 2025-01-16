<?php
include('dbconn.php');

try {
    // Set parameters from DataTables request
    $draw = intval($_POST['draw']);
    $limit = intval($_POST['length']);
    $offset = intval($_POST['start']);
    $searchValue = $_POST['search']['value'] ?? '';

    // Columns array for searchable columns
    $columns = ['dname', 'ucode', 'srcdes', 'date', 'remarks'];
    
    // Base query
    $baseQuery = "FROM records";
    $whereClause = "";
    $params = [];
    
    // Search filter
    if (!empty($searchValue)) {
        $searchConditions = [];
        foreach ($columns as $column) {
            $searchConditions[] = "$column LIKE ?";
            $params[] = "%$searchValue%";
        }
        $whereClause = "WHERE (" . implode(" OR ", $searchConditions) . ")";
    }
    
    // Total records query
    $totalQuery = "SELECT COUNT(*) as total FROM records";
    $totalResult = $pdo->query($totalQuery);
    $totalData = $totalResult->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Filtered records query
    $filteredQuery = "SELECT COUNT(*) as total $baseQuery $whereClause";
    $filteredStmt = $pdo->prepare($filteredQuery);
    $filteredStmt->execute($params);
    $totalFiltered = $filteredStmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Main query sorted by `ucode`
    $query = "SELECT * $baseQuery $whereClause ORDER BY ucode DESC LIMIT $limit OFFSET $offset";
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Response for DataTables
    $response = [
        "draw" => $draw,
        "recordsTotal" => $totalData,
        "recordsFiltered" => $totalFiltered,
        "data" => $data
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);

} catch (PDOException $e) {
    $response = [
        "error" => "Database error: " . $e->getMessage(),
        "draw" => intval($_POST['draw']),
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => []
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} finally {
    $pdo = null;
}
?>
