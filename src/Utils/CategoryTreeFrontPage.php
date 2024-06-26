<?php

namespace App\Utils;

use App\Utils\AbstractClasses\CategoryTreeAbstract;

class CategoryTreeFrontPage extends CategoryTreeAbstract
{
    public $mainParentId, $mainParentName, $currentCategoryName;

    public function getCategoryListAndParent(int $id): string
    {
        $parentData = $this->getMainParent($id);
        $this->mainParentName = $parentData['name'];
        $this->mainParentId = $parentData['id'];
        $key = array_search($id, array_column($this->categoriesArrayFromDB, 'id'));
        $this->currentCategoryName = $this->categoriesArrayFromDB[$key]['name'];

        $categories_array = $this->buildTree($parentData['id']);
        return $this->getCategoryList($categories_array);
    }

    public function getCategoryList(array $categories_array)
    {
        $this->categorylist .= '<ul>';
        foreach ($categories_array as $value) {
            $catName = $value['name'];
            $url = $this->urlgenerator->generate('app_category', ['categoryname' => $catName, 'id' => $value['id']]);
            $this->categorylist .= '<li>' . '<a href="' . $url . '">' . $value['name'] . '</a>';
            if (!empty($value['children'])) {
                $this->getCategoryList($value['children']);
            }
            $this->categorylist .= '</li>';
        }
        $this->categorylist .= '</ul>';
        return $this->categorylist;
    }

    public function getMainParent(int $id): array
    {
        $key = array_search($id, array_column($this->categoriesArrayFromDB, 'id'));

        // Check if key exists and is not false (indicating the ID was not found)
        if ($key !== false) {
            if ($this->categoriesArrayFromDB[$key]['parent_id'] !== null) {
                return $this->getMainParent($this->categoriesArrayFromDB[$key]['parent_id']);
            } else {
                return [
                    'id' => $this->categoriesArrayFromDB[$key]['id'],
                    'name' => $this->categoriesArrayFromDB[$key]['name']
                ];
            }
        } else {
            // Handle the case where the ID is not found
            return [];
        }
    }

    public function getChildIds(int $parent): array
    {
        static $ids = [];
        foreach ($this->categoriesArrayFromDB as $val) {
            if ($val['parent_id'] == $parent) {
                $ids[] = $val['id'] . ',';
                $this->getChildIds($val['id']);
            }
        }

        return $ids;
    }
}
