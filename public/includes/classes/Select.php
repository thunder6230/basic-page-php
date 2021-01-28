<?php 
class Select extends Textarea {
  
    public function renderSelect(){

        $out = '';
        $out .= $this->renderLabel();
        $out .= $this->renderSelectTag();
        $out .= $this->renderTagAttributes();
        $out .= ">";

        foreach($this->options as $value => $option){
            $out .= "<option value='$value'>$option</option>";
        }

        $out .= "</select></div>";
        return $out;
    }

    public function renderSelectTag(){
        return  "<select name='$this->name' id='$this->id'";
    }
}
