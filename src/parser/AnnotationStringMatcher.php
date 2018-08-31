<?php
	namespace Dadlian\Addendum;

  class AnnotationStringMatcher extends ParallelMatcher {
    protected function build() {
      $this->add(new AnnotationSingleQuotedStringMatcher);
      $this->add(new AnnotationDoubleQuotedStringMatcher);
    }
  }
?>
