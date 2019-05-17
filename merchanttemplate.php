<div class="col-sm-3 float-left">
  <div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
      <img src="img/avatar.png" class="rounded mx-auto d-block img-fluid" alt="Nura">
      <h1 class="text-center" id="fullName">
        <?php
        $email = $_COOKIE['userLogged'];
        $sql = "SELECT firstName, lastName, roleID FROM users where email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($fname, $lname, $rid);
        $row = $stmt->fetch();
        echo $fname . " " . $lname;
        mysqli_stmt_close($stmt);
        ?>
      </h1>
      <p class="text-center" id="accountType">Merchant</p>
      <br><br>
      <a href="#" class="btn btn-outline-secondary btn-block" role="button">
      Products  &nbsp
      <!--<span class="badge badge-dark">
        <?php

        ?>
      </span>-->
      </a>
      <a href="#" class="btn btn-outline-secondary btn-block" role="button">
      Messages  &nbsp
      <!--<span class="badge badge-dark">3</span>-->
      </a>
      <a href="#" class="btn btn-outline-secondary btn-block" role="button">
      Change Password
      </a>

    </div>
  </div>
</div>
