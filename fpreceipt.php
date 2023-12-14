<?php 
  include("config.php");
  require ("fpdf/fpdf.php");

  include("function.php");

  $booking = $_GET['booking_id'];

  $sql = "SELECT * FROM booking WHERE booking_id = '$booking' ";
  $res = mysqli_query($connection, $sql);

  $sqlbill = "SELECT * FROM billing WHERE booking_id = '$booking' ";
  $resbill = mysqli_query($connection, $sqlbill);
  $rowbill = mysqli_fetch_assoc($resbill);

  $sql2 = "SELECT * FROM invoice WHERE booking_id = '$booking' ";
  $res2 = mysqli_query($connection, $sql2);
  $row2 = mysqli_fetch_assoc($res2);

  if(mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);

    
    //check kung anong event then punta sa table na yun
    $event_type = $row['event'];
    if($event_type == 'Wedding'){
      $sql_check = "SELECT * FROM wedding WHERE booking_id = '$booking' " ; 
      $res_check = mysqli_query($connection, $sql_check);
      $row_show = mysqli_fetch_assoc($res_check);
    } else if ($event_type == 'Corporate'){
      $sql_check = "SELECT * FROM corporate WHERE booking_id = '$booking' " ; 
      $res_check = mysqli_query($connection, $sql_check);
      $row_show = mysqli_fetch_assoc($res_check);
    } else if ($event_type == 'Anniversary'){
      $sql_check = "SELECT * FROM anniversary WHERE booking_id = '$booking' " ; 
      $res_check = mysqli_query($connection, $sql_check);
      $row_show = mysqli_fetch_assoc($res_check);
    } else if ($event_type == 'Birthday'){
      $sql_check = "SELECT * FROM birthday WHERE booking_id = '$booking' " ; 
      $res_check = mysqli_query($connection, $sql_check);
      $row_show = mysqli_fetch_assoc($res_check);
    } else if ($event_type == 'Christening'){
      $sql_check = "SELECT * FROM christening WHERE booking_id = '$booking' " ; 
      $res_check = mysqli_query($connection, $sql_check);
      $row_show = mysqli_fetch_assoc($res_check);
    } else {
      ?><script type="text/javascript">
        alert('Invoice not found. Please contact Glamour Events for further details');
        window.location.href='contact.php';
        </script>
      <?php 
    }

      $info=[
          "customer"=>$row['firstname']." ".$row['lastname'],
          "address"=> $row['address'],
          "phone"=>$row['phone'],
          "booking_no"=>$row['booking_id'],
          "receipt_no"=>$rowbill['receipt_id'],
          "billing_no"=>$rowbill['billing_id'],
          "downpayment"=>$row['downpayment'],
          "total_amt"=>$row['amount'],
        ];
  }

  $sql3 = "SELECT * FROM booking WHERE booking_id = '$booking' ";
  $res3 = mysqli_query($connection, $sql3);
  if(mysqli_num_rows($res3) > 0){
    $row3 = mysqli_fetch_assoc($res3);
      $product_info=[
          "venue"=>$row3['venueprice'],
          "cuisine"=> $row3['cuisineprice'],
          "style"=>$row3['styleprice'],
          "services"=>$row3['serviceprice'],
          "venue_name"=>$row_show['venue'],
          "cuisine_name"=>$row_show['cuisine'],
          "style_name"=>$row_show['style'],
          "services_name"=>$row_show['extra_services'],
        ];
  }

  
  class PDF extends FPDF{
    function Header(){
      
      //Display Company Info
      $this->SetFont('Arial','B',14);
      $this->Cell(50,10,"GLAMOUR",0,1);
      $this->SetFont('Arial','',14);
      $this->Cell(50,7,"glamourovrthink@gmail.com",0,1);
      $this->Cell(50,7,"Intramuros, Manila",0,1);
      $this->Cell(50,7,"09453391986",0,1);
      
      //Display INVOICE text
      $this->SetY(15);
      $this->SetX(-40);
      $this->SetFont('Arial','B',18);
      $this->Cell(50,10,"RECEIPT",0,1);
      
      //Display Horizontal line
      $this->Line(0,48,210,48);
    }

    function body($info, $product_info){
      //Billing Details
      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"Bill To: ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$info["customer"],0,1);
      $this->Cell(50,7,$info["address"],0,1);
      $this->Cell(50,7,$info["phone"],0,1);

      //Display Invoice no
      $this->SetY(55);
      $this->SetX(-60);
      $this->Cell(50,7,"Booking No : ".$info["booking_no"]);

      //Display Invoice no
      $this->SetY(63);
      $this->SetX(-60);
      $this->Cell(50,7,"Receipt No : ".$info["receipt_no"]);
      
      //Display Invoice date
      $this->SetY(71);
      $this->SetX(-60);
      $this->Cell(50,7,"Billing No : ".$info["billing_no"]);
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(150,9,"CHOSEN OPTIONS",1,0);
      $this->Cell(40,9,"PRICE",1,1,"C");
      $this->SetFont('Arial','',10);

      //display table product rows
      //$this->Cell(150,9,$product_info["venue_name"],"LR",0);
      //$this->Cell(40,9,$product_info["venue"],"R",1,"R");

      //$this->Cell(150,9,$product_info["cuisine_name"],"LR",0);
      //$this->Cell(40,9,$product_info["cuisine"],"R",1,"R");

      //$this->Cell(150,9,$product_info["style_name"],"LR",0);
      //$this->Cell(40,9,$product_info["style"],"R",1,"R");

      //$this->Cell(150,9,$product_info["services_name"],"LR",0);
      //$this->Cell(40,9,$product_info["service"],"R",1,"R");

      $this->Cell(150, 9, $product_info["venue_name"], "LTR", 0, 'L');
      $this->Cell(40, 9, $product_info["venue"], "TR", 1, "R");

      $this->Cell(150, 9, $product_info["cuisine_name"], "LR", 0, 'L');
      $this->Cell(40, 9, $product_info["cuisine"], "R", 1, "R");

      $this->Cell(150, 9, $product_info["style_name"], "LR", 0, 'L');
      $this->Cell(40, 9, $product_info["style"], "R", 1, "R");

      $this->Cell(150, 9, $product_info["services_name"], "LRB", 0, 'L');
      $this->Cell(40, 9, $product_info["services"], "RB", 1, "R");

      
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(150,9,"AMOUNT CURRENTLY PAID",1,0,"R");
      $this->Cell(40,9,$info["downpayment"],1,1,"R");

      $this->Cell(150,9,"TOTAL AMOUNT PAID",1,0,"R");
      $this->Cell(40,9,$info["total_amt"],1,1,"R");
      
      //Display amount in words
      $this->SetY(225);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,9,"Completed amount paid for the whole transaction",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(0,9,"PHP ".$info["total_amt"],0,1);
      
    }


    function Footer(){
      
      //set footer position
      $this->SetY(-50);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,10,"Glamour Event Planning and Management",0,1,"R");
      $this->Ln(5);
      $this->SetFont('Arial','',12);
      $this->Cell(0,5,"Thank you for choosing Glamour",0,1,"R");
      $this->SetFont('Arial','',10);
      
      //Display Footer Text
      $this->Cell(0,30,"---------------This is a Glamour computer generated receipt---------------",0,1,"C");
      
    }
  }


  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info, $product_info);
  //$pdf->body($info,$products_info);
  $pdf->Output();
?>