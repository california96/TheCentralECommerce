
<?php
    session_start();
  /*  echo "<h3> PHP List All Session Variables</h3>";
    foreach ($_SESSION as $key=>$val)
    echo $key." ".$val."<br/>";
    echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';*/
class Cart{
  protected $cart_contents = array();

  public function __construct(){
  $this->cart_contents = !empty($_SESSION['cart_contents'])?$_SESSION['cart_contents']:NULL;
  // retrieve cart_contents or nothing
  if ($this->cart_contents === NULL){
           //initialize
           $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
         }
  }
  public function contents(){
    $cart = array_reverse($this->cart_contents);

    unset($cart['total_items']);
    unset($cart['cart_total']);

    return $cart;
  }

  public function retrieve_item($productID){
    return (in_array($id, array('total_items', 'cart_total'), TRUE) OR ! isset($this->cart_contents[$productID]))
           ? FALSE
           : $this->cart_contents[$productID];
  }
  public function total_items(){
    return $this->cart_contents['total_items'];
  }
  public function total(){
    return $this->cart_contents['cart_total'];
  }
  public function insert($item = array()){
    if(!is_array($item) OR count($item) === 0){
      return FALSE;
    }else{
      if(!isset($item['productID'], $item['productName'], $item['productPrice'], $item['productImage'], $item['qty'])){
                  return FALSE;
              }else{
                  /*
                   * Insert Item
                   */
                  // prep the quantity
                  $item['qty'] = (float) $item['qty'];
                  if($item['qty'] == 0){
                      return FALSE;
                  }
                  // prep the price
                  $item['productPrice'] = (double) $item['productPrice'];
                  // create a unique identifier for the item being inserted into the cart
                  $productID = $item['productID'];
                  // get quantity if it's already there and add it on
                  $old_qty = isset($this->cart_contents[$productID]['qty']) ? (int) $this->cart_contents[$productID]['qty'] : 0;
                  // re-create the entry with unique identifier and updated quantity
                  $item['productID'] = $productID;
                  $item['qty'] += $old_qty;
                  $this->cart_contents[$productID] = $item;

                  // save Cart Item
                  if($this->save_cart()){
                      return isset($productID) ? $productID : TRUE;
                  }else{
                      return FALSE;
                  }
              }
          }
      }
  public function update($item = array()){
    if (!is_array($item) OR count($item) === 0){
           return FALSE;
       }else{
           if (!isset($item['productID'], $this->cart_contents[$item['productID']])){
               return FALSE;
           }else{
               if(isset($item['qty'])){
                   $item['qty'] = (double) $item['qty'];
                   if ($item['qty'] == 0){
                       unset($this->cart_contents[$item['productID']]);
                       return TRUE;
                   }
               }

               // find updatable keys
               $keys = array_intersect(array_keys($this->cart_contents[$item['productID']]), array_keys($item));
               // prep the price
               if(isset($item['productPrice'])){
                   $item['productPrice'] = (double) $item['productPrice'];
               }
               // product id & name shouldn't be changed
               foreach(array_diff($keys, array('id', 'name' )) as $key){
                   $this->cart_contents[$item['productID']][$key] = $item[$key];
               }
               // save cart data
               $this->save_cart();
               return TRUE;
           }
       }
  }
  protected function save_cart(){
    $this->cart_contents['total_items'] = $this->cart_contents['cart_total'] = 0;
    foreach($this->cart_contents as $key => $val){
      if(!is_array($val) OR !isset($val['productPrice'], $val['qty'])){
               continue;}
        $this->cart_contents['cart_total'] += ($val['productPrice'] * $val['qty']);
        $this->cart_contents['total_items'] += $val['qty'];
        $this->cart_contents[$key]['subtotal'] = ($this->cart_contents[$key]['productPrice'] * $this->cart_contents[$key]['qty']);
    }

    //empty cart = remove from session
    if(count($this->cart_contents)<=2){
      unset($_SESSION['cart_contents']);
      return FALSE;
    }
    else{
      $_SESSION['cart_contents'] = $this->cart_contents;
      return TRUE;
    }
  }
  public function remove($productID){
    unset($this->cart_contents[$productID]);
    $this->save_cart();
    return TRUE;
  }

  public function destroy(){
    $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
    unset($_SESSION['cart_contents']);
  }
}
 ?>
