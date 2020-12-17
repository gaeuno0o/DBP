<?php
    $link = mysqli_connect('localhost','admin','admin','employees');

    //만약 접속이 안될때 예외처리
    if(mysqli_connect_errno()){
        echo "MariaDB 접속에 실패했습니다. 관리자에게 문의하세요.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }

    $query = "
        SELECT d.dept_no, d.dept_name, m.emp_no, e.first_name 
        FROM departments d, dept_manager m, employees e
        WHERE d.dept_no = m.dept_no 
        AND e.emp_no = m.emp_no ORDER BY 1"
        ; 

    $result = mysqli_query($link,$query);

    $article = '';
    while($row = mysqli_fetch_array($result)){
        $article .= '<tr><td>'; 
        $article .= $row['dept_no'];
        $article .= '</td><td>';
        $article .= $row['dept_name'];
        $article .= '</td><td>';
        $article .= $row['emp_no'];
        $article .= '</td><td>';
        $article .= $row['first_name'];
        $article .= '</td></tr>';
    }

    //연결 끊기
    mysqli_free_result($result);
    mysqli_close($link);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> 부서별 매니저 정보 </title>
    <style>
    body {
        font-family: Consolas, monospace;
        font-family: 12px;
    }

    table {
        width: 100%;
    }

    th,td {
        padding: 10px;
        border-bottom: 1px solid #dadada;
    }
    </style>
</head>

<body>
    <h2><a href="index.php">직원 관리 시스템</a> | 부서별 매니저 정보</h2>
    <table>
        <tr>
            <th>dept_no</th>
            <th>dept_name</th>
            <th>emp_no</th>
            <th>first_name</th>            
        </tr> 
        <?= $article ?>       
    </table>
    
</body>

</html>