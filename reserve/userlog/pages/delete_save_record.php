<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_302']) && isset($_POST['record_id_302'])) {
        $record_id_302 = $_POST['record_id_302'];
        $sql = "DELETE FROM restore302 WHERE id = $record_id_302";
    }

    if (isset($_POST['delete_303']) && isset($_POST['record_id_303'])) {
        $record_id_303 = $_POST['record_id_303'];
        $sql = "DELETE FROM restore303 WHERE id = $record_id_303";
    }
}

header("Location: unitsave.php");
exit();
?>
