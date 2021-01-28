<?php 

class Input {
    protected $div_class = '';
    protected $name = '';
    protected $type = '';
    protected $id = '';
    protected $required = '';
    protected $tag_attributes = [];
    protected $label = '';
    protected $label_class = '';
    protected $error_messages = [];
    protected $options = [];
    
    

    public function __construct($config){
        
        if (isset($config['div_class'])) {
            $this->div_class = $config['div_class'];
        } else {
            die("Error, no div class provided!");
        }
        if(isset($config['name'])){
            $this->name = $config['name'];
        }else {
            die("Error, no name provided!");
        }
        if (isset($config['type'])) {
            $this->type = $config['type'];
        } else{
            die("Error, no type provided!");
        }
        if (isset($config['id'])) {
            $this->id = $config['id'];
        } else {
            die("Error, no name provided!");
        }

        $this->label_class = $config['label_class'] ?? '';
        $this->label = $config['label'] ?? '';
        $this->required = $config['required'];
        if(isset($config['error_messages'])){
            $this->error_messages[] = $config['error_messages'];
        }
        if(isset($config['tag_attributes'])){
            $this->tag_attributes = $config['tag_attributes'];
        }
        if (isset($config['options'])) {
            $this->options = $config['options'];
        }
        
    }

    public function render(){
        $out = '';
        $out .= $this->renderLabel();
        $out .= $this->renderInput();
        $out .= $this->renderTagAttributes();
        $out .= '>';
        $out .= $this->renderErrorDiv();
        $out .= '</div>';

        return $out;
    }
    
    //We place the opening div  and generate the label
    public function renderLabel(){
        $row = '';
        $row .= "<div class=\"$this->div_class\">";
        $row .= "<label for=\"$this->id\" class=\"$this->label_class\">$this->label</label>";
        return $row;
    }
    //rendering the input field with base 
    public function renderInput(){
        $row = '';
        $row .= "<input type=\"$this->type\" id=\"$this->id\" name=\"$this->name\" $this->required ";

        return $row;
    }
    //we add the rest of the input attributes
    public function renderTagAttributes(){
        $row = '';
        foreach($this->tag_attributes as $key => $attribute)
        $row .= "$key=\"$attribute\" ";
        return $row;
    }
    //finally we generate the error divs if its not empty
    public function renderErrorDiv(){
        $row = '';
        if(count($this->error_messages) > 0){
            $row .= "<div class='invalid-feedback'>";
            foreach($this->error_messages as $message){
                    $row .= $message;
            }
            $row .= "</div>";
        }
        return $row;
    }
}
?>