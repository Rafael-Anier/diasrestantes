<html>
 <head>
  <title>Dias restantes</title>
 </head>
 <style>
table, th, td {
  border: 1px solid black;
  padding: 15px;
  width: 50%;
}
td.large {
   font-size:50px;
   width: 10%;
}
td {
   font-size:20px;
}
td.medium {
   font-size:30px;
}
</style>
 <body>
 <?php 


    $hoy = date('yy-m-d');




   $pdo = new PDO("sqlite:diasrestantes.db");
 $stmt = $pdo->prepare('SELECT asignatura as Asignatura, min(entrega) as Entrega , pec as Pec FROM todo  where entrega > :hoy group by asignatura order by Entrega ');

 $stmt->setFetchMode(PDO::FETCH_ASSOC);
 $stmt->execute(array('hoy'=>$hoy));
 
    while ($row = $stmt->fetch()) 
 {
       $diferencia = floor((strtotime($row['Entrega']) - strtotime($hoy))/(60*60*24));
   
      echo "   <table>";
      echo "    <tr>";
      echo "     <td rowspan=3 class=large>"  .$diferencia . "</td>";
      echo "      <td class=medium>" .$row['Asignatura']. "</td>   ";
      echo "    </tr>";
      echo "    <tr>";
      echo "      <td>". $row['Pec']. "</td>";
      echo "    </tr>";
      echo "    <tr>";
      echo "      <td>". $row['Entrega'] ."</td>";
      echo "    </tr>";
      echo "  </table> ";

 }

 
 ?>
 </body>
</html>
