<?php

$db = mysqli_connect('localhost', 'root', '', 'database');

$query = mysqli_query($db, "SELECT * FROM categories ORDER BY `level` ASC");

$categories = $query->fetch_all(MYSQLI_ASSOC);

$result = [];

foreach ($categories as $category){
    if ($category['parent_id'] == 0){
        $result[$category['id']] = [
            'name' => $category['name'],
            'childrens' => [],
        ];
    } else {
        $result = recursion($result, $category);
    }
}


function recursion($categories, $toWrite){
    if (isset($categories[$toWrite['parent_id']])){
        $categories[$toWrite['parent_id']]['childrens'][$toWrite['id']] = [
            'name' => $toWrite['name'],
            'childrens' => []
        ];

        return $categories;
    }

    foreach ($categories as $key => $category){
        $category['childrens'] = recursion($category['childrens'], $toWrite);

        $categories[$key] = $category;
    }

    return $categories;
}

function recursionResponse($categories){
    $html = '<div class="categories">';

    foreach ($categories as $category){
        $html .= '<div class="category">
                     <p>' . $category['name'] . '</p>';

        if ($category['childrens']){
            $html .= recursionResponse($category['childrens']);
        }

        $html .= '</div>';
    }

    $html .= '</div>';

    return $html;
}

?>


<html>
    <style>
        .category{
            border: 1px solid silver;
            padding: 10px;
        }
    </style>
    <body>
        <?php echo recursionResponse($result); ?>
    </body>
</html>
