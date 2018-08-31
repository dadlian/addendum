<?php
	namespace Dadlian\Addendum;

  class AnnotationTopValueMatcher extends AnnotationValueMatcher {
    protected function process($value) {
      return array('value' => $value);
    }
  }
?>
