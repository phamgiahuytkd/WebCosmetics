<!-- TITLE -->
<script language="javascript">
    document.title = "Hóa đơn"; 
</script>
<!-- ------------------------------------------------------------ -->
<!-- ========================= PHẦN ẨN KHÔNG XÓA ========================================= -->
<div class="modal_delete hide">
    <div class="modal_delete_inner">
        <div class="modal_delete_header">
            <p>Xóa phiếu</p>
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="modal_delete_body">
            <h4>Bạn sẽ không thể khôi phục thao tác này</h2>
        </div>
        <div  class="modal_delete_footer">
            <form method = "post" name = "form_confrim_deletion" id = "form_confrim_deletion" onsubmit="return false">
                <input class="product_toDelete" type = "text" readonly id = "delete_product_input" name = "delete_product_input">
                <div class="modal_delete_footer-inner">
                    <input class="accept_delete" type="button" value="Xác nhận" name = "delete_product" onclick= "check_form_submit()">
                </div>
            </form>
        </div>
    </div>
</div>
		
<script>
    //ham xoa product_code khi chon nhiu
    function delete_product_input_code(){
        document.getElementById("delete_product_input").value = "";
    }
    
    //ham lay ma san pham tu bang
    function get_code_product_delete(code){
        document.getElementById("delete_product_input").value = code;
    }
    
    // ham chon form submit xoa san pham
    function check_form_submit(){
        if(document.getElementById("delete_product_input").value == ""){
            document.getElementById("form_check_product").submit();
            
        }
        else{
            document.getElementById("form_confrim_deletion").submit();
            
        }
        
    }
    
    <?php
    
    
        //ham xoa mot san pham
        if(isset($_POST["delete_product_input"])){
            $product_code = $_POST["delete_product_input"];
            $result_product = get_product_code($conn, $product_code);
            $row_product = mysqli_fetch_array($result_product);
            if($row_product['img'] != ""){
                unlink("img/product/".$row_product['img']."");	
            }
            
            delete_product($conn, $product_code);
        }
        
        //ham xoa nhieu san pham
        if(isset($_POST['check_list'])) {
            foreach($_POST['check_list'] as $selected) {
                $result_product = get_product_code($conn, $selected);
                $row_product = mysqli_fetch_array($result_product);
                if($row_product['img'] != ""){
                    unlink("img/product/".$row_product['img']."");	
                }
                
                delete_product($conn, $selected);
            }
        }
    ?>
</script>

        <!-- =============== ADD STOCK OUT (DELIVERY) POPUP MODAL =============== -->
        <div class="modal_stockOut hide">
            <form method="post" enctype="multipart/form-data">
                <div class="modal_stockOut_inner">
                    <div class="modal_stockOut_header">
                        <p>Lập phiếu xuất kho</p>
                        <div><i class="fa-solid fa-circle-xmark"></i></div>
                    </div>
                    <div class="modal_stockOut_body">
                        <div class="modal_stockOut_element">
                            <label for="stockOut_id">Mã phiếu xuất</label>
                            <input type="text" id="stockOut_id" placeholder="Mã phiếu xuất" name="stockOut_id">
                        </div>
                        <div class="modal_stockOut_element">
                            <label for="stockOut-inventory_name">Tên hàng hóa</label>
                            <input type="text" id="stockOut-inventory_name" placeholder="Tên hàng hóa xuất kho" name="stockOut-inventory_name">
                        </div>
                        <div class="modal_stockOut_element">
                            <label for="stockOut_quantity">Số lượng</label>
                            <input type="text" id="stockOut_quantity" placeholder="Số lượng xuất kho" name="stockOut_quantity">
                        </div>
                        <div class="modal_stockOut_element">
                            <label for="stockOut_storehouse_id">Mã kho</label>
                            <input type="text" id="stockOut_storehouse_id" placeholder="Kho chứa hàng hóa" name="stockOut_storehouse_id">
                        </div>
                        <div class="popup_form-element select-category-wrapper">
							<select id="select_category_edit">
								<option value="category_select">Xuất đến kiot</option>
								<option value="quanly">Kiot 01</option>
								<option value="nhanvien">Kiot 03</option>
								<option value="thukho">Kiot Lê Lai</option>
							</select>
                        </div>
                        <div class="modal_stockOut_element modal_stockOut_element_time">
                            <label for="stockOut-time">Thời gian xuất kho: </label>
                            <input
                            type="datetime-local"
                            id="stockOut-time"
                            name="stockOut-time"/>
                        </div>
                    </div>
                    <div class="modal_stockOut_footer">
                            <input type="submit" class="btn_ad" value="Xuất kho" name = "add_stockOut">
                    </div>
                </div>
							
            </form>
        </div>
<!-- ======================================================================================================== -->

        <!-- =============== STOCK IN n OUT (RECEIPT AND DELIVERY) DETAIL POPUP MODAL =============== -->
        <div class="modal_detail hide">
            <form method="post" enctype="multipart/form-data">
                <div class="modal_detail_inner">
                    <div class="modal_detail_header">
                        <p>Chi tiết hóa đơn</p>
                        <div><i class="fa-solid fa-circle-xmark"></i></div>
                    </div>
                    <div class="modal_detail_body">
                        <div class="modal_detail_element">
                            <label for="bill_detail_id">Mã hóa đơn:</label>
                            <p>HD009</p>
                        </div>
                        <div class="modal_detail_element">
                            <label for="bill_detail_kiot_id">Kiot:</label>
                            <p>Kiot-NVC</p>
                        </div>
                        <div class="modal_detail_element">
                            <table class="calculate_table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>Trà đá đường</td>
                                        <td><p>1</p></td>
                                        <td><p>10000</p></td>
                                        <td class="netPrice"><p>10000</p></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"><p>Tổng</p></td>
                                        <td><p>10000</p></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="modal_detail_element modal_detail_element_time">
                            <label for="bill_detail-time">Thời gian: </label>
                            16/11/2023 7:45
                        </div>
                    </div>
                </div>
							
            </form>
        </div>
        <!-- ========================= HOME SECTION ========================= -->
		
        <section class="home-section">
            <nav>
                <div class="sidebar-button">
                    <i class="bx bx-menu sidebarBtn"></i>
                    <span class="home-content_text">Hóa đơn</span>
                </div>
                <div class="search-box">
                    <input id="search-input" class="form-control" type="text" placeholder="Tìm kiếm..." />
                    <i class="bx bx-search"></i>
                </div>
            </nav>
            
            <div class="filter">
                <button class="filter_btn btn-filter filter_text-label"> 
                    Kiot01
                </button>
                <button class="filter_btn btn-filter filter_text-label"> 
                    Kiot-NVC
                </button>
                <button class="filter_btn btn-filter filter_text-label"> 
                    k009
                </button>
                <div class="filter_page">
                    <button class="filter_btn btn-filter filter_product-btn hide_none" id="show_add-product">
                        <i class='bx bx-plus'></i>
                        Nhập kho
                    </button>
                    <button class="edit-product_icon filter_btn btn-filter filter_product-btn hide_none" id="show_StockOut">
                        <i class='bx bx-plus'></i>
                        Xuất kho
                    </button>
                    <button class="filter_btn btn-filter filter_product-btn disabled delete-product hide_none" disabled="disabled" id="del_btn" type="submit" onclick = "delete_product_input_code()">
                        <i class='bx bxs-trash'></i>
                        Xóa phiếu
                    </button>
                </div>
            </div>

            <!-- ================================ PHẦN ẨN KHÔNG XÓA ============================================= -->
            <!-- ============================== ADD STOCK IN (RECEIPT) ===================================================== -->
            <div class="popup">
                <form method="post" enctype="multipart/form-data" onsubmit="return(check_product());" name="form_add_product" >
                    <div class="popup-container">
                        <div class="close-popup-btn" title="Đóng"><i class='bx bxs-x-circle'></i></div>
                        <div class="popup_form">
                            <h2>Lập phiếu nhập kho</h2>
                            <div class="popup_form-element">
                                <label for="stockIn_id">Mã phiếu nhập</label>
                                <input type="text" id="stockIn_id" placeholder="Mã phiếu nhập" name = "stockIn_id">
                            </div>

                            <div class="popup_form-element">
                                <label for="stockIn-inventory_name">Tên hàng hóa</label>
                                <input type="text" id="stockIn-inventory_name" placeholder="Tên hàng hóa xuất kho" name="stockIn-inventory_name">
                            </div>
                            <div class="popup_form-element">
                                <table class="calculate_table">
                                   <thead>
                                        <tr>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Tổng</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr>
                                            <td><input type="text" onkeyup="quantityfunc(this)"></td>
                                            <td><input type="text" onkeyup="pricefunc(this)"></td>
                                            <td class="netPrice">0</td>
                                        </tr>
                                   </tbody>
                                </table>
                            </div>
                            <div class="popup_form-element">
                                <label for="stockIn_storehouse_id">Mã kho</label>
                                <input type="text" id="stockIn_storehouse_id" placeholder="Kho chứa hàng hóa" name="stockIn_storehouse_id">
                            </div>
                            <div class="popup_form-element">
                                <label for="stockIn_account">Nhân viên nhập kho</label>
                                <input type="text" id="stockIn_account" placeholder="Nhân viên nhập kho" name="stockIn_account">
                            </div>
                            <div class="popup_form-element modal_stockIn_element_time">
                                <label for="stockIn-time">Thời gian nhập kho: </label>
                                <input
                                type="datetime-local"
                                id="stockIn-time"
                                name="stockIn-time"/>
                            </div>
                            
                            <div class="popup_form-element">
                                <input type="submit" class="btn_ad" value="Nhập kho" name="add_stockIn">
                            </div>
                            
                        </div>
                    </div>
					<script>
						
						let ar_product_code = [];
						
						//ham chi nhap so
						function isNumberKey(e) {
							var charCode = (e.which) ? e.which : e.keyCode;
							if (charCode > 31 && (charCode < 48 || charCode > 57))
								return false;
							return true;
						}
					<?php	
						$n_product = 0;
						$result_product = get_product($conn);
						//kiem tra su trung lap cua ma san pham
						while($row_product = mysqli_fetch_array($result_product)){
							?>
								ar_product_code[<?php echo json_encode($n_product);?>] = <?php echo json_encode($row_product["product_code"]);?>;
								
							<?php
							$n_product = $n_product +1;
						}
						
					?>
						//kiem tra kich thuoc anh 
						
						
						
						
						//============================================================//
						function check_product(){
							//kiem tra ma san pham
							if(document.form_add_product.product_code.value == ""){
								  document.form_add_product.product_code.focus();
								  var change = document.getElementById("product_code");
								  change.classList.add('change-eror');
								  document.form_add_product.product_code.placeholder = "Vui lòng nhập mã sản phẩm!";								  
								  return false;
							  }
							
							 for (let i = 0; i < ar_product_code.length; i++) {
								 if(document.form_add_product.product_code.value == ar_product_code[i]){
									document.form_add_product.product_code.focus();
									 var change = document.getElementById("product_code");
									change.classList.add('change-eror');
									document.form_add_product.product_code.value = "";
									document.form_add_product.product_code.placeholder = "Mã sản phẩm đã tồn tại!";
									return false;
									break;
								 }
							 }
							 
							 //kiem tra ten san pham
							 if(document.form_add_product.product_name.value == ""){
								  document.form_add_product.product_name.focus();
								  var change = document.getElementById("product_name");
								  change.classList.add('change-eror');
								  document.form_add_product.product_name.placeholder = "Vui lòng nhập tên sản phẩm!";								  
								  return false;
							  }
							 //kiem tra gia 
								var regex=/^[0-9]+$/;
								if (!document.form_add_product.product_price.value.match(regex))
								{
									document.form_add_product.product_price.focus();
									var change = document.getElementById("product_price");
									change.classList.add('change-eror');
									document.form_add_product.product_price.value = "";
									document.form_add_product.product_price.placeholder = "Giá bạn vừa nhập không hợp lệ!";
									return false;
								}
							//kiem tra hinh anh
							//--kiem tra kich thuoc anh
							const oFile = document.getElementById("product_img-file").files[0];
							if (oFile.size > 2097152) // 2 MiB for bytes.
							{
							  alert("Kích thước hình ảnh quá lớn!");
							  return false;
							}
							
							//--kiem tra phan mo rong cua anh
							var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
							if(!allowedExtensions.exec(oFile.name)){
								alert('Vui lòng upload các file có định dạng: .jpeg/.jpg/.png/.gif !');
								return false;
							}
							
							
							
						}
						<?php
							if(isset($_POST['add_product'])){
								$product_code = $_POST['product_code'];
								$product_name = $_POST['product_name'];
								$price = $_POST['product_price'];
								
								$directory = $_POST['product_directory'];
								
								//xu ly anh
								$file_path = "img/product/";
								$img_name = basename($_FILES['product_img']['name']);
								$img_path =  $file_path . $img_name;
								if(file_exists($img_path) && $img_name!="") {
									$rand = rand(0, 300);
									$img_name = "new_" . $rand . $img_name;
									$img_path =  $file_path . $img_name;
								}
								move_uploaded_file($_FILES["product_img"]["tmp_name"], $img_path);
								$img = $img_name;
								add_product($conn, $product_code, $product_name, $price, $img, $directory);
							}
						?>
					</script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                </form>
            </div>
    <!-- ============================================================================================================== -->
            
    <!-- ============================ VIEW DETAIL TABLE =============================== -->
			
            <div class="table">
                <div class="table_section">
                    <table class="product-table">
					<form method = "post" enctype="multipart/form-data" name = "form_check_product" id = "form_check_product">
                        <thead>
                            <tr>
                                <th>
                                    <label for="SelectAll">
                                        <input type="checkbox" id="SelectAll" name="">
                                    </label>
                                </th>
								<th>STT</th>
                                <th>Mã hóa đơn<span>   &uarr;</span></th>
                                <th>Kiot<span>   &uarr;</span></th>
                                <th>Tổng<span>   &uarr;</span></th>
                                <th>Thời gian<span>   &uarr;</span></th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_product-table">
						<?php
						//lay thong tin san pham
							$result_product = get_product($conn);
							$stt = 0;
							while($row_product = mysqli_fetch_array($result_product)){
							
							
							
							
							
						?>
						
                            <tr>
                                <td>
                                    <input type="checkbox" class="select" name="check_list[]" value = "<?php echo $row_product["product_code"]; ?>">
                                </td>
								<td> <?php echo $stt; $stt = $stt+1;?> </td>
                                <td><strong>HD01</strong></td>
                                <td>Kiot03</td>
                                <td>500.000</td>
                                <td data-timestamp="1671840000">09/11/2023</td>
                                <td>
                                    <button title="Chi tiết" type="button" class="detail_icon">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                     
                                    <button title="Xóa" type="button" class="delete-product_icon hide_none" onclick="get_code_product_delete('<?php echo $row_product["product_code"]; ?>')" >
                                        <i class='bx bxs-trash'></i>
                                    </button>
                                </td>
                            </tr>
                          <?php
							}
						  ?>  
                        </tbody>
						</form>
                    </table>
					
                </div>
            </div>
        </section>
		