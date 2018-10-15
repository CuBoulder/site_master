
<h2>Foo</h2>

<pre>
 <?php
   $class_methods = get_class_methods($data);

   foreach ($class_methods as $method_name) {
     echo "$method_name\n";
   }

   print_r($data->current());

 ?>
</pre>



