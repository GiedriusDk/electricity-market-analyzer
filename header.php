<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php
        $headerText = "Electricity Market Analyzer";

        // Get the current page file name (index.php, about.php, contact.php)
        $currentPage = basename($_SERVER['PHP_SELF']);
    ?>

    <header>
        <h1><?php echo $headerText; ?></h1>
        <nav>
            <a href="index.php" <?php if ($currentPage === 'index.php') echo 'class="selected"'; ?>>Home</a> |
            <a href="about.php" <?php if ($currentPage === 'about.php') echo 'class="selected"'; ?>>About</a> |
            <a href="contact.php" <?php if ($currentPage === 'contact.php') echo 'class="selected"'; ?>>Contact</a> |
            <a href="solutions.php" <?php if ($currentPage === 'solutions.php') echo 'class="selected"'; ?>>Solutions</a>
        </nav>
    </header>
