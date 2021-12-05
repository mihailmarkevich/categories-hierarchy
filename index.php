<?php

$db = mysqli_connect('localhost', 'root', '', 'database');

$query = mysqli_query($db, "
               SELECT c.id, c.name, ctc.parent_category_id
               FROM categories c 
			   LEFT JOIN categories_to_categories ctc on c.name = ctc.name  
			   ORDER BY ctc.level ASC");

$categories = $query->fetch_all(MYSQLI_ASSOC);

$result = [];

foreach ($categories as $category) {
    if(is_null($category['parent_category_id'])){
        $result[$category['id']] = [
            'name' => $category['name'],
            'childrens' => [],
        ];
    } else {
        $result = $this->recursion($result, $category['parent_category_id'], $category);
    }
}

function recursion($categories, $parentId, $toWrite){
    if (isset($categories[$parentId])) {
        $categories[$parentId]['childrens'][$toWrite['id']] = [
            'name' => $toWrite['name'],
            'childrens' => []
        ];

        return $categories;
    }

    foreach ($categories as $key => $category) {
        $category['childrens'] = $this->recursion($category['childrens'], $parentId, $toWrite);

        $categories[$key] = $category;
    }

    return $categories;
}