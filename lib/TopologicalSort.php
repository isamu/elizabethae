<?PHP
class TopologicalSort{
    var $nodes = array();

    function TopologicalSort($classes = array()){
        $this->setNode($classes);
    }

    function setNode($classes = array()){
        $this->nodes = array();
        foreach($classes  as $class_name => $class){
            $classes["root"]["required"][] = $class_name;
            foreach((array) $class["require"] as $require){
                $this->set_required($classes, $require, $class_name);
            }
        }
        
        foreach($this->getDependencyList($classes) as $depend) {
            list($parent, $child) = each($depend);
            if(!isset($this->nodes[$parent])){
                $this->nodes[$parent] = $this->getNewNode($parent);
            }
            if(!isset($this->nodes[$child])){
                $this->nodes[$child] = $this->getNewNode($child);
            }
            if(!in_array($child,$this->nodes[$parent]['children'])){
                $this->nodes[$parent]['children'][] = $child;
            }
            if(!in_array($parent,$this->nodes[$child]['parents'])){
                $this->nodes[$child]['parents'][] = $parent;
            }
        }
    }

    function set_required(&$classes, $require, $class_name){
        if(!isset($classes[$require])){
            return false;
        }
        if(!is_array($classes[$require]["required"])){
            $classes[$require]["required"] = array();
        }
        if(!in_array($require, $classes[$require]["required"])){
            $classes[$require]["required"][] = $class_name;
        }
    }

    function sort(){
        $root_nodes = array_values($this->getRootNodes($this->nodes));

        $sorted = array();
        while(count($this->nodes)>0) {
            if(count($root_nodes) == 0){
                return false;
            }
            $n = array_pop($root_nodes);
            $sorted[] = $n['name'];

            for($i=(count($n['children'])-1); $i >= 0; $i--) {
                $childnode = $n['children'][$i];
                unset($this->nodes[$n['name']]['children']);
                $parent_position = array_search($n['name'],$this->nodes[$childnode]['parents']);
                unset($this->nodes[$childnode]['parents'][$parent_position]);
                if(!count($this->nodes[$childnode]['parents'])){
                    array_push($root_nodes, $this->nodes[$childnode]);
                }
            }
            unset($this->nodes[$n['name']]);
        }
        unset($sorted[0]);
        return array_values($sorted);
    }

    function getRootNodes($nodes){
        $output = array();
        foreach($nodes as $name => $node){
            if (!count($node['parents'])){
                $output[$name] = $node;
            }
        }
        return $output;
    }

    function getDependencyList($classes = array()){
        $output = array();
        foreach($classes as $classname => $class){
            foreach((array) $class['required'] as $required){
                $output[] = array($classname => $required);
            }
        }
        return $output;
    }

    function getNewNode($name){
        return array("name" => $name,
                     "children" => array(),
                     "parents" => array());
    }
}

?>