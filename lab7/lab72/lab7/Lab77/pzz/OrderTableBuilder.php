<?php

class OrderTableBuilder{
    private $content = [];

    public function addRow($first_column_content, $second_column_content){
        $this->content[] = [$first_column_content, $second_column_content];
    }

    public function getTable(){
        $result = '<table class="order-table">';

        foreach($this->content as $row){
            $first_column_content = $row[0];
            $second_column_content = $row[1];
            $result .= "<tr><td class='order-td'>$first_column_content</td><td class='order-td'>$second_column_content</td></tr>";
        }

        $result .= '</table>';
        return $result;
    }

    private function addAdditionalIngredient($addIngredient, $prices){
        if(isset($_POST[$addIngredient]) and $_POST[$addIngredient] === $addIngredient){
            $this->addRow($addIngredient, $prices[$addIngredient]);
        }
    }

    public function addAdditionalIngredients($addIngredients, $prices){
        foreach($addIngredients as $addIngredient){
            $this->addAdditionalIngredient($addIngredient, $prices);
        }
    }
}