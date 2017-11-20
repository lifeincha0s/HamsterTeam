<?php
function GenerateQuest($Question){
echo "<div class='Question'>";
        echo "<p style='padding-left:15px'>$Question[question]</p>";
 echo "<p style='padding-left:25px'>
        <br>
        <table>
        <tr>
                <th>N/A</th>
                <th>Strongly<br>Disagree</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Neutral</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Strongly<br>Agree</th>

        </tr>";
echo    "<tr>";
                echo"<form action='Answer'>";
                   echo "<td><input type='radio'name='".$Question[question_ID]."' value='0'></td>";
                   echo "<td><input type='radio'name='".$Question[question_ID]."' value='1'></td>";
                   echo "<td><input type='radio'name='".$Question[question_ID]."' value='2'></td>";
                   echo "<td><input type='radio'name='".$Question[question_ID]."' value='3'></td>";
                   echo "<td><input type='radio'name='".$Question[question_ID]."' value='4'></td>";
                   echo "<td><input type='radio'name='".$Question[question_ID]."' value='5'></td>";
                   echo "<td><input type='radio'name='".$Question[question_ID]."' value='6'></td>";
                   echo "<td><input type='radio'name='".$Question[question_ID]."' value='7'></td>";
                   echo "<td><input type='radio'name='".$Question[question_ID]."' value='8'></td>";
                   echo "<td><input type='radio'name='".$Question[question_ID]."' value='9'></td>";
echo"</form>
        </tr>
        <tr>
                <td>0</td>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
        </tr>
        </table>
        </div>
        </br>";
        }
        ?>
