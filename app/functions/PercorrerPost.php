public class PercorrerPost{
  public function percorrerArrayPost{

    echo "<hr>";
          $query_string = " ";
          if ($_POST) {
            $kv = array();
            foreach ($_POST as $key => $value) {
              $kv[] = "$key=$value";
            }
            $query_string = join("&", $kv);
          }
          else {
            $query_string = $_SERVER["QUERY_STRING"];
          }
          echo $query_string;     
    }
  }