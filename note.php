<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit();
}

$showAlert = false;
$showError = false;
$alertType = ''; // Initialize alert type variable

// Check if form is submitted to delete a note
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {
    include 'partials/_dbconnect.php';
    $note_id = $_POST['note_id'];

    $sql = "DELETE FROM note WHERE sr_no = ? AND sno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $note_id, $_SESSION['sno']);

    if ($stmt->execute()) {
        $showAlert = "Note deleted successfully!";
        $alertType = "alert-danger"; // Set alert type to danger (red) when note is deleted
    } else {
        $showError = "Error deleting note: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Check if form is submitted to add a new note
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['action'])) {
    include 'partials/_dbconnect.php';

    if (isset($_SESSION['sno'])) {
        $sno = $_SESSION['sno'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        $sql = "INSERT INTO note (sno, title, description, dt) VALUES (?, ?, ?, current_timestamp())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $sno, $title, $description);

        if ($stmt->execute()) {
            $showAlert = "Note added successfully!";
            $alertType = "alert-success"; // Set alert type to success (green) when note is added
        } else {
            $showError = "Error adding note: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $showError = "User ID is not set in the session.";
    }

    $conn->close();
}

// Fetch notes from the database for the current user
if (isset($_SESSION['sno'])) {
    include 'partials/_dbconnect.php';
    $sno = $_SESSION['sno'];

    $sql = "SELECT * FROM note WHERE sno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sno);
    $stmt->execute();

    $result = $stmt->get_result();
    $notes = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $conn->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Welcome - <?php echo $_SESSION['username']; ?></title>
</head>

<body>
    <?php require 'partials/_nav.php'; ?>

    <div class="container my-5">
        <?php
        if ($showAlert) {
            echo '<div class="alert ' . $alertType . '" role="alert">' . $showAlert . '</div>';
        }
        if ($showError) {
            echo '<div class="alert alert-danger" role="alert">' . $showError . '</div>';
        }
        ?>

        <form action="note.php" method="post">
            <div class="form-group">
                <label for="title">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Note Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>

        <hr>

        <h2>Your Notes</h2>
        <div class="row">
            <?php
            if (!empty($notes)) {
                foreach ($notes as $note) {
                    ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body alert-info">
                                <h5 class="card-title"><?php echo htmlspecialchars($note['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($note['description']); ?></p>
                                <form action="note.php" method="post" class="text-right">
                                    <input type="hidden" name="note_id" value="<?php echo $note['sr_no']; ?>">
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $note['sr_no']; ?>">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $note['sr_no']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this note?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <form action="note.php" method="post">
                                                        <input type="hidden" name="note_id" value="<?php echo $note['sr_no']; ?>">
                                                        <button type="submit" name="action" value="delete" class="btn btn-danger">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-muted text-right">
                                <small><?php echo htmlspecialchars($note['dt']); ?></small>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="alert alert-info" role="alert">No notes found.</div>';
            }
            ?>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDzwrnQq4xF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
