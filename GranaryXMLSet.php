<?php

class GranaryXMLSet extends GranaryXMLNode implements ArrayAccess, Iterator
{
  private $iterPosition = 0;

  private function set() {
    return $this->xml->children();
  }

  public function count() {
    return $this->set()->count();
  }

  // Iterator interface functions
  function rewind() {
       $this->iterPosition = 0;
   }
   function current() {
       return $this->offsetGet($this->iterPosition);
   }
   function key() {
       return $this->iterPosition;
   }
   function next() {
       ++$this->iterPosition;
   }
   function valid() {
       return $this->offsetExists($this->iterPosition);
   }

  // ArrayAccess interface functions
  public function offsetSet($offset,$value) {
      if (is_null($offset)) {
          $this->set()[] = $value;
      } else {
          $this->set()[$offset] = $value;
      }
  }
  public function offsetExists($offset) {
      return isset($this->set()[$offset]);
  }
  public function offsetUnset($offset) {
      if ($this->offsetExists($offset)) {
          unset($this->set()[$offset]);
      }
  }
  public function offsetGet($offset) {
      return $this->offsetExists($offset) ? new GranaryXMLElement($this->set()[$offset], $this->db) : null;
  }

}

?>
