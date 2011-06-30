<?PHP
namespace elizabethae\util;

class TopologicalSort{
    var $nodes = array();

    function TopologicalSort($classes = array()){
        $this->setNode($classes);
    }

    function setNode($classes = array()){
        $this->nodes = array();
        foreach(array_keys($classes) as $class_name){
            $this->nodes[$class_name] = $this->getNewNode($class_name);
        }
        foreach($classes  as $class_name => $class){
            if(isset($class['require'])){
                $this->set_dependency((array) $class['require'], (array) $class_name);
            }
            if(isset($class['required'])){
                $this->set_dependency((array) $class_name, (array) $class['required']);
            }
        }
    }

    function set_dependency($parents, $children){
        foreach($parents as $parent){
            foreach($children as $child){
                if(!empty($parent) && !empty($child)){
                    if(!isset($this->nodes[$parent]) || !isset($this->nodes[$child])){
                        throw new \Exception('no dependency method');
                    }
                    if(!in_array($child, $this->nodes[$parent]['children'])){
                        $this->nodes[$parent]['children'][] = $child;
                    }
                    $this->nodes[$child]['parents'][] = $parent;
                }
            }
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

    function getNewNode($name){
        return array("name" => $name,
                     "children" => array(),
                     "parents" => array());
    }
}

?>