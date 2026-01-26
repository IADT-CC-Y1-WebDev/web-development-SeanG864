<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/03-arrays.php">View Example &rarr;</a>
    </div>

    <h1>Arrays Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Favorite Movies</h2>
    <p>
        <strong>Task:</strong> 
        Create an indexed array with 5 of your favorite movies. Use a for 
        loop to display each movie with its position (e.g., "Movie 1: 
        The Matrix").
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $movies = ['Scream', 'Scream 2', 'Scream 3', 'Scream 4', 'Scream 5', ];
        for ($i = 0; $i < count($movies); $i++) {
            echo "<p>$movies[$i]<p>";
        }
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Student Record</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array for a student with keys: name, studentId, 
        course, and grade. Display this information in a formatted sentence.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $sInfo = [
            "name" => "Sean",
            "studentId" => "n00253864",
            "course" => "Creative Computing",
            "grade" => 88
        ];

        $text = 
            "{$sInfo['name']} {$sInfo['studentId']}" .
            " {$sInfo['course']} {$sInfo['grade']}.";

        print("<p>$text</p>");
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Country Capitals</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array with at least 5 countries as keys and their 
        capitals as values. Use foreach to display each country and capital 
        in the format "The capital of [country] is [capital]."
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $countries = [
            "France" => "Paris",
            "Spain" => "Barcelona",
            "Japan" => "Tokyo",
            "Ireland" => "Dublin"
        ];

        echo "<ul>";
        foreach ($countries as $country => $capital) {
            echo "<li>$capital is the capital of $country<li>";
        }
        echo "</ul>";
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Menu Categories</h2>
    <p>
        <strong>Task:</strong> 
        Create a nested array representing a restaurant menu with at least 
        2 categories (e.g., "Starters", "Main Course"). Each category should 
        have at least 3 items with prices. Display the menu in an organized 
        format.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $products = [
            'starters' => [
                'bread' => "Copier & Multipurpose",
                'soup' => "Inkjet Printer",
                '' => "Laser Printer",
            ],
            'main' => [
                'ball' => "Ball Point",
                'hilite' => "Highlighters",
                'marker' => "Markers",
            ],
            'dessert' => [
                'tape' => "Sticky Tape",
                'glue' => "Adhesives",
                'clips' => "Paperclips",
            ]
        ];
        echo "<p>Our most expensive product is {$products['starters']['copier']}.</p>";
        ?>
    </div>

</body>
</html>
