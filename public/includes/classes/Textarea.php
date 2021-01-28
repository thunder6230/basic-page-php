<?php 
class Textarea extends Input {


    public function renderTextarea(){
        $out = '';
        $out .= $this->renderLabel();
        $out .= "<textarea name='$this->name' id='$this->id' ";
        $out .= $this->renderTagAttributes();
        $out .= "></textarea></div>";
        return $out;
    }
}
?>