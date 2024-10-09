function changeview(){

   
    var signinbox = document.getElementById("signinbox");
    var signupbox = document.getElementById("signupbox");

    signinbox.classList.toggle("d-none");
    signupbox.classList.toggle("d-none");
}

function signup(){
    
    var fn = document.getElementById("fname");
    var ln = document.getElementById("lname");
    var e = document.getElementById("email");
    var pw = document.getElementById("password");
    var m = document.getElementById("mobile");
    var g = document.getElementById("gender");

    var f = new FormData();
    f.append("fname",fn.value);
    f.append("lname",ln.value);
    f.append("email",e.value);
    f.append("password",pw.value);
    f.append("mobile",m.value);
    f.append("gender",g.value);

    var r= new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4 && r.status ==200){
            var t = r.responseText;

            if(t=="success"){
                document.getElementById("p").innerHTML = t;
                document.getElementById("msg").className="alert alert-success  col-4 text-center rounded ";
                var signinbox = document.getElementById("signinbox");
                var signupbox = document.getElementById("signupbox");

                signinbox.classList.toggle("d-none");
                signupbox.classList.toggle("d-none");
                
                
            }else{
                document.getElementById("p").innerHTML = t;
                document.getElementById("msg").className="d-block";
                document.getElementById("msg").className="alert alert-danger col-4 text-center rounded ";
            }
        }
        
    
    }       


        
    
    r.open("POST","signUpProcess.php",true);
    r.send(f);
}


function signin(){
    var e = document.getElementById("email2");
    var pw = document.getElementById("password2");
    var rem = document.getElementById("rem");

    var f =new FormData();
    f.append("email",e.value);
    f.append("password",pw.value);
    f.append("rem",rem.checked);    

    var r = new XMLHttpRequest();
    
    r.onreadystatechange = function(){
        if(r.readyState == 4 && r.status ==200){
            var t = r.responseText;

            
            if(t=="success"){
                window.location = "home.php";
            }else if(t=="successblocked"){
                alert("System Admin has blocked your account");
            }else{
                alert(t);
            }
        }

    }

    r.open("POST","signInProcess.php",true);
    r.send(f);
}

var bm; 

function forgotPassword(){
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4 && r.status == 200){
            var t = r.responseText;
            if(t == "success"){
                var m= document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();
            }else{
                alert (t);
            }
        }
    }

    r.open("GET","forgotPasswordProcess.php?e="+email.value,true);
    r.send();

}

function resetPassword(){
    var email = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var f = new FormData();

    f.append("e",email.value);
    f.append("np",np.value);
    f.append("rnp",rnp.value);
    f.append("vc",vc.value);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4 && r.status ==200){
            var t = r.responseText;

            if(t == "success"){
                bm.hide();
                alert ("Your password has been updated");
                window.location.reload();
            }else{
                alert(t);
            }
        }
    }

    r.open("POST","resetPasswordProcess.php",true);
    r.send(f);
}

function showPassword1(){
    var np= document.getElementById("np");
    var npb = document.getElementById("npb");

    if(np.type=="password"){
        np.type = "text";
        npb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    }else{
        np.type = "password";
        npb.innerHTML = '<i class="bi bi-eye"></i>';
    }
}

function showPassword2(){

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if(rnp.type == "password"){
        rnp.type = "text";
        rnpb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    }else{
        rnp.type = "password";
        rnpb.innerHTML = '<i class="bi bi-eye"></i>';
    }

}

function changeSearchView(){

    var search = document.getElementById("se"); 
    search.classList.toggle("d-none");
}






function updateProfile(){

    
    var profile_img = document.getElementById("profileImage");
    var first_name = document.getElementById("fname");
    var last_name = document.getElementById("lname");
    var mobile_no = document.getElementById("mobile");
    var password = document.getElementById("pw");
    var email_address = document.getElementById("email");
    var address_line_1 = document.getElementById("line1");
    var address_line_2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var postal_code = document.getElementById("pc");

    var f = new FormData();
    f.append("img",profile_img.files[0]);
    f.append("fn",first_name.value);
    f.append("ln",last_name.value);
    f.append("mn",mobile_no.value);
    f.append("pw",password.value);
    f.append("ea",email_address.value);
    f.append("al1",address_line_1.value);
    f.append("al2",address_line_2.value);
    f.append("p",province.value);
    f.append("d",district.value);
    f.append("c",city.value);
    f.append("pc",postal_code.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.status == 200 && r.readyState == 4){
            var t = r.responseText;

            if(t == "success"){
                alert("Profile Successfully Updated")
                
                window.location = "userProfile.php";
            }else{
                alert (t);
            }
            
        }
    }

    r.open("POST","userProfileUpdateProcess.php",true);
    r.send(f);
}
function advancedSearch(x){

    var txt = document.getElementById("t");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var condition = document.getElementById("c2");
    var color = document.getElementById("c3");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s");

    var f = new FormData();

    f.append("t",txt.value);
    f.append("cat",category.value);
    f.append("b",brand.value);
    f.append("mo",model.value);
    f.append("con",condition.value);
    f.append("col",color.value);
    f.append("pf",from.value);
    f.append("pt",to.value);
    f.append("s",sort.value);
    f.append("page",x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.status == 200 && r.readyState == 4){
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST","advancedSearchProcess.php",true);
    r.send(f);

}
function loadBrands(){

    var category = document.getElementById("category").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.status == 200 && r.readyState == 4){
            var t = r.responseText;

            document.getElementById("brand").innerHTML = t;
            
        }
    }

    r.open("GET","loadBrandProcess.php?c=" + category,true);
    r.send();
    
}

function loadModel(){
   

    var brand = document.getElementById("brand").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.status == 200 && r.readyState == 4){
            var t = r.responseText;
            

            document.getElementById("model").innerHTML = t;
        
            
        }
    }

    r.open("GET","loadModelProcess.php?b=" + brand,true);
    r.send();
    
}

function changeProductImage() {

    var images = document.getElementById("imageuploader");

    images.onchange = function () {

        var file_count = images.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + " files uploaded. You are proceed to upload 03 or less than 03 files.");
        }

    }

}

function addProduct(){

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var condition = 0;
    if(document.getElementById("b").checked){
        condition = 1;
    }else if(document.getElementById("u").checked){
        condition = 2;
    }
    var clr = document.getElementById("clr");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("ca",category.value);
    f.append("b",brand.value);
    f.append("m",model.value);
    f.append("t",title.value);
    f.append("con",condition);
    f.append("col",clr.value);
    f.append("qty",qty.value);
    f.append("cost",cost.value);
    f.append("dwc",dwc.value);
    f.append("doc",doc.value);
    f.append("desc",desc.value);
    
    var file_count = image.files.length;
    for(var x = 0;x < file_count;x++){
        f.append("img" + x,image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.status == 200 && r.readyState == 4){
            var t = r.responseText;

            if( t.trim()=="s" || t.trim()=="ss" || t.trim()=="sss" ){
                alert ("Product Added Successfully");
                window.location="home.php";
            }else{
                alert (t);
            }
            
        }
    }

    r.open("POST","addProductProcess.php",true);
    r.send(f);

}

function addColor(){
    var cl= document.getElementById("clr_in").value;

    var r= new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.status == 200 && r.readyState==4){
            var t = r.responseText;
            alert(t);
            window.location="addProduct.php";
            
        }
    }

    r.open("GET","addColorProcess.php?clr="+cl,true);
    r.send();
}

function changeStatus(id) {

    var product_id = id;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if(t == "activated" || t == "deactivated"){
                window.location.reload();
            }else{
                alert(t);
            }
        }
    }

    r.open("GET", "changeStatusProcess.php?p=" + product_id, true);
    r.send();

}

function sort(x) {

    var search = document.getElementById("s");
    var time = "0";

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var qty = "0";

    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    }

    var condition = "0";

    if (document.getElementById("b").checked) {
        condition = "1";
    } else if (document.getElementById("u").checked) {
        condition = "2";
    }

    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("c", condition);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("sort").innerHTML = t;

        }
    }

    r.open("POST", "sortProcess.php", true);
    r.send(f);

}

function Reportsort(x) {

    var search = document.getElementById("s");
    

    var f = new FormData();
    f.append("s", search.value);
   
    f.append("page",x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("sort").innerHTML = t;

        }
    }

    r.open("POST", "reportSortProcess.php", true);
    r.send(f);

}

function clearSort() {
    window.location.reload();
}

function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if(t == "s"){
                window.location = "updateProduct.php";
            }else{
                alert(t);
            }
        }
    }

    r.open("GET", "sendIdProcess.php?id=" + id, true);
    r.send();

}

function sortChange(){

    var sr = document.getElementById("sr"); 
    sr.classList.toggle("d-none");

}



function updateProduct() {
    var title = document.getElementById("t");
    var qty = document.getElementById("q");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("d");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("cost",cost.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("d", description.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("i" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                alert("Product Updated Succesfully")
                window.location = "myProducts.php";
            } else if (t == "Invalid Image Count") {

                if (confirm("Don't you want to update Product Images?") == true) {
                    window.location = "myProducts.php";
                } else {
                    alert("Select images.");
                }
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateProductProcess.php", true);
    r.send(f);
}

function deletep(did){
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
            
            var r = new XMLHttpRequest();

          r.onreadystatechange = function () {
              if (r.status == 200 && r.readyState == 4) {
                  var t = r.responseText;
                  if (t == "s") {
                      window.location = "myProducts.php";
  
                  } else {
                      
                  }
              }
          }
      
  
      r.open("GET", "deleteProduct.php?did=" + did, true);
      r.send();
        }else{
            
        }
        
      });

   

    
}
function signout(){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4 && r.status == 200){
            var t = r.responseText;

            if(t == "success"){

                window.location.reload();
                window.location = "index.php";

            }else{
                alert (t);
            }
        }
    }

    r.open("GET","signoutProcess.php",true);
    r.send();
    
}

function 
gnout(){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4 && r.status == 200){
            var t = r.responseText;

            if(t == "success"){

                window.location.reload();
                window.location = "adminSignIn.php";

            }else{
                alert (t);
            }
        }
    }

    r.open("GET","adminsignoutProcess.php",true);
    r.send();
    
}

function addToCart(id) {
    
    var pqty=document.getElementById("pqty").value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {
                Swal.fire("Product Alredy Exsist in the cart");
            } else if (t == 2) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Product Added",
                    showConfirmButton: false,
                    timer: 1500
                  });
               
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addToCartProcess.php?id=" +id+"&pqty="+pqty, true);
    r.send();

}



function addToCartHome(id) {
    
    var pqty='1';
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {
                Swal.fire("Product Alredy Exsist in the cart");
            } else if (t == 2) {
                
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Product Added",
                    showConfirmButton: false,
                    timer: 1500
                  });
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addToCartProcess.php?id=" +id+"&pqty="+pqty, true);
    r.send();

}

function removeFromCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "deleted") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromCartProcess.php?id=" + id, true);
    r.send();

}

function addToWatchlist(id){

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.status == 200 && r.readyState == 4){
            var t = r.responseText;
            if(t == 1){
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Product Added",
                    showConfirmButton: false,
                    timer: 1500
                  });
                
            }else if(t == 2){
                Swal.fire("Product removed from Watch list");
                
            }else{
                alert(t);
            }
            
        }
    }

    r.open("GET","addWatchListProcess.php?id="+id,true);
    r.send();

}

function removeFromWatchlist(id){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.status == 200 && r.readyState == 4){
            var t = r.responseText;
            if(t == "Deleted"){
                window.location.reload();
            }else{
                alert(t);
            }
            
            
        }
    }

    r.open("GET","removeFromWatchListProcess.php?id="+id,true);
    r.send();
}

function basicSearch(x) {
    var text = document.getElementById("kw").value;
    var select = document.getElementById("c").value;

    var f = new FormData();
    f.append("t", text);
    f.append("s", select);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}

function adminVerification(){
    var email = document.getElementById("e");

    var f = new FormData();
    f.append("e",email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "Success"){
                var adminVerificationModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            }else{
                alert(t);
            }
        }
    }

    r.open("POST","adminVerificationProcess.php",true);
    r.send(f);
}

function verify(){
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "success"){
                av.hide();
                window.location = "adminPanel.php";
            }else{
                alert (t);
            }
            
        }
    }

    r.open("GET","verificationProcess.php?v="+verification.value,true);
    r.send();
}

function changeADP(){
    

    var ap=document.getElementById("ap");
    var ds1=document.getElementById("ds1");
    var ds2=document.getElementById("ds2");
    var dd1=document.getElementById("dd1");

    ap.classList.toggle("d-none");
    ds2.classList.toggle("d-none");
    ds1.classList.toggle("d-none");
    dd1.classList.toggle("offset-lg-1");
    
}

function blockUser(email){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "blocked"){
                document.getElementById("ub"+email).innerHTML = "Unblock";
                document.getElementById("ub"+email).classList = "btn btn-success";
            }else if(txt == "unblocked"){
                document.getElementById("ub"+email).innerHTML = "Block";
                document.getElementById("ub"+email).classList = "btn btn-danger";
            }else{
                alert (txt);
            }
        }
    }

    request.open("GET","userBlockProcess.php?email="+email,true);
    request.send();

}

function blockProduct(id){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4){
            var txt = request.responseText;
            if(txt == "blocked"){
                document.getElementById("pb"+id).innerHTML = "Unblock";
                document.getElementById("pb"+id).classList = "btn btn-success";
            }else if(txt == "unblocked"){
                document.getElementById("pb"+id).innerHTML = "Block";
                document.getElementById("pb"+id).classList = "btn btn-danger";
            }else{
                alert (txt);
            }
        }
    }

    request.open("GET","productBlockProcess.php?id="+id,true);
    request.send();

}

function viewC(){
    var vC = document.getElementById("vC");
    vC.classList.toggle("d-none");
}



function addNewCategory(){
    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var pm;
function viewProductModal(id){
    var m = document.getElementById("viewProductModal"+id);
    pm = new bootstrap.Modal(m);
    pm.show();
}

function saveCategory(){
    var txt = document.getElementById("txt").value;

    var f = new FormData();
    f.append("t",txt);
    f.append("e",e);
    f.append("n",n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "success"){
                vc.hide();
                window.location.reload();
            }else{
                alert (t);
            }
        }
    }

    r.open("POST","SaveCategoryProcess.php",true);
    r.send(f);
}
function verifyCategory(){
    var ncm = document.getElementById("addCategoryVerificationModal");
    vc = new bootstrap.Modal(ncm);

    e = document.getElementById("e").value;
    n = document.getElementById("n").value;

    var f = new FormData();
    f.append("email",e);
    f.append("name",n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "Success"){
                cm.hide();
                vc.show();
            }else{
                alert (t);
            }
        }
    }
    r.open("POST","addNewCategoryProcess.php",true);
    r.send(f);
}

function paynow(pid) {

    var qty = document.getElementById("pqty").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            
            var obj = JSON.parse(t);

            var umail = obj["umail"];
            var amount = obj["amount"];
            var owner_mail = obj["owner_mail"];

            if (t == "address error") {
                alert("Please Update Your Profile.");
                window.location = "userProfile.php";
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(obj["id"],pid,umail,amount,qty,owner_mail);
                    

                    

                    
                    
                    // Note: validate the payment and show success or failure page to the customer
                };


                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1224091",    // Replace your Merchant ID
                    "return_url": "http://localhost/myproject/singleProduct.php?id=" + pid,     // Important
                    "cancel_url": "http://localhost/eshop/singleProductView.php?id=" + pid,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": umail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                    payhere.startPayment(payment);
                // };

            }
        }
    }

    r.open("GET", "payNowProcess.php?id=" + pid + "&qty=" + qty, true);
    r.send();

}

function cartch(pid) {

    var qty = document.getElementById("pqty").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            
            var obj = JSON.parse(t);

            var umail = obj["umail"];
            var amount = obj["amount"];
            var owner_mail = obj["owner_mail"];

            if (t == "address error") {
                alert("Please Update Your Profile.");
                window.location = "userProfile.php";
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(obj["id"],pid,umail,amount,qty,owner_mail);
                    

                    

                    
                    
                    // Note: validate the payment and show success or failure page to the customer
                };


                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1224091",    // Replace your Merchant ID
                    "return_url": "http://localhost/myproject/singleProduct.php?id=" + pid,     // Important
                    "cancel_url": "http://localhost/eshop/singleProductView.php?id=" + pid,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": umail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                    payhere.startPayment(payment);
                // };

            }
        }
    }

    r.open("GET", "payNowProcess.php?id=" + pid + "&qty=" + qty, true);
    r.send();

}



function saveInvoice(orderId,id,mail,amount,qty,owner_mail){

    var f = new FormData();
    f.append("o",orderId);
    f.append("i",id);
    f.append("m",mail);
    f.append("a",amount);
    f.append("q",qty);
    f.append("ow",owner_mail)

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "1"){

                window.location = "invoice.php?id="+orderId;

            }else{
                alert (t);
            }
        }
    }

    r.open("POST","saveInvoice.php",true);
    r.send(f);

}

function mpSearch(x){
    var mp = document.getElementById("mp").value;

    var f= new FormData();
    f.append("t",mp);
    f.append("page",x);

    var r= new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.status == 200 && r.readyState==4){
            var t = r.responseText;
            
            document.getElementById("mpSearchResult").innerHTML = t; 
        }
    }

    r.open("POST","mpSearchProcess.php",true);
    r.send(f);
    
}

function muSearch(x){
    var mp = document.getElementById("mu").value;

    var f= new FormData();
    f.append("t",mp);
    f.append("page",x);

    var r= new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.status == 200 && r.readyState==4){
            var t = r.responseText;
            
            document.getElementById("muSearchResult").innerHTML = t; 
        }
    }

    r.open("POST","muSearchProcess.php",true);
    r.send(f);
    
}


function searchInvoiceId() { 
    var txt = document.getElementById("searchtxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            document.getElementById("viewArea").innerHTML = t;
            
        }
    }

    r.open("GET","searchInvoiceIdProcess.php?id="+txt,true);
    r.send();
}

function searchInvoiceId() { 
    var txt = document.getElementById("searchtxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            
            document.getElementById("viewArea").innerHTML = t;
            
        }
    }

    r.open("GET","searchInvoiceIdProcess.php?id="+txt,true);
    r.send();
}

function findSellings(){

    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            document.getElementById("viewArea").innerHTML = t;
        }
    }

    r.open("GET","findSellingsProcess.php?f="+from+"&t="+to,true);
    r.send();

 }



var m;
function addFeedback(id,){
    var feedbackModal = document.getElementById("feedbackModal"+id);
    m = new bootstrap.Modal(feedbackModal);
    m.show();
}

function send_msg(){
    var recevr_mail = document.getElementById("rmail");
    var msg_txt = document.getElementById("msg_txt");

    var f = new FormData();
    f.append("rm",recevr_mail.innerHTML);
    f.append("mt",msg_txt.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "success"){
                document.getElementById("chat_box").reload();
            }else{
                alert (t);
            }
        }
    }

    r.open("POST","sendMsgProcess.php",true);
    r.send(f);
}



function sendAdminMsg(){
    var subject = document.getElementById("subject").value;
    var txt = document.getElementById("msgtxt").value;
    var email = document.getElementById("email").value;
    var name = document.getElementById("name").value;

    var f = new FormData();
    
    f.append("s",subject);
    f.append("t",txt);
    f.append("e",email);
    f.append("n",name);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState == 4){
            var t = r.responseText;
            if ( t == '1'){
                alert ("Message Sent Succesfully")
                window.location = "home.php";
            }else if(t=="2"){
                alert("You Are Not A Registered User")
            }else{
             alert (t);   
            }
            
           
        }
    }

    r.open("POST","sendAdminMessageProcess.php",true);
    r.send(f);
 }
 

 
 
 function saveFeedback(id,invoice_id){
 
     var type;
 
     if(document.getElementById("star1").checked){
         type = 1;
     }else if(document.getElementById("star2").checked){
         type = 2;
     }else if(document.getElementById("star3").checked){
         type = 3;
     }else if(document.getElementById("star4").checked){
        type = 4;
    }else if(document.getElementById("star5").checked){
        type = 5;
    }

    
 
     var feedback = document.getElementById("feed");
 
     var f = new FormData();
     f.append("pid",id);
     f.append("t",type);
     f.append("i",invoice_id);
     f.append("feed",feedback.value);


 
     var r = new XMLHttpRequest();
 
     r.onreadystatechange = function () { 
         if(r.readyState == 4){
             var t = r.responseText;
             if(t == "1"){
                 alert("Thank you for your feedback");
                 window.location="home.php";
             }else{
                 alert (t);
             }
         }
      }
 
     r.open("POST","saveFeedbackProcess.php",true);
     r.send(f);
 
 }

 function genPDF(){
    const element = document.getElementById("page");

    var opt = {
        margin:       0,
        
        filename:     'NewTech',
        image:        { type: 'jpeg', quality: 1 },
        html2canvas:  { scale: 1 },
        jsPDF:        { unit: 'in', format: 'A4', orientation: 'portrait' }
      };
      

    html2pdf()
    .set(opt)
    .from(element)
    .save()
 }

 function contactAdmin(email){
    var m = document.getElementById("contactAdmin");
    cam = new bootstrap.Modal(m);
    cam.show();
 }

 function DAB() {

    const submitButton = document.getElementById("mub");
    const input = document.getElementById("mu");
   
    input.addEventListener('keyup',(e)=>{
       const value = e.currentTarget.value;
       submitButton.disabled =false;
   
       if (value ===""){
           submitButton.disabled=true;
       }
       
   
    });
   
 }

 function DAB1() {

    const submitButton = document.getElementById("mpb");
    const input = document.getElementById("mp");
   
    input.addEventListener('keyup',(e)=>{
       const value = e.currentTarget.value;
       submitButton.disabled =false;
   
       if (value ===""){
           submitButton.disabled=true;
       }
       
   
    });
   
 }

 function printInvoice(){
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}

function checkOut() {
    // alert("OK");

    var f = new FormData();
    f.append("cart", true);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            // alert(response);
            var payment = JSON.parse(response);
            doCheckout(payment, "checkoutProcess.php");

        }

    };

    request.open("POST", "paymentProcess.php", true);
    request.send(f);

}

function doCheckout(payment, path) {

    // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer

        var f = new FormData();
        f.append("payment", JSON.stringify(payment));

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 & request.status == 200) {
                var response = request.responseText;
                // alert(response);
                if (response == "Success") {
                    reload();
                } else {
                    alert(response);
                }

            }

        };

        request.open("POST", path, true);
        request.send(f);

    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:" + error);
    };

    // Show the payhere. js popup, when "PayHere Pay" is clicked
    // document.getElementById('payhere-payment').onclick = function (e) {
    payhere.startPayment(payment);
    //};

}
 

document.addEventListener('DOMContentLoaded', (event) => {
    const htmlElement = document.documentElement;
    const switchElement = document.getElementById('darkModeSwitch');

    // Set the default theme to dark if no setting is found in local storage
    const currentTheme = localStorage.getItem('bsTheme') || 'dark';
    htmlElement.setAttribute('data-bs-theme', currentTheme);
    switchElement.checked = currentTheme === 'dark';

    switchElement.addEventListener('change', function () {
        if (this.checked) {
            htmlElement.setAttribute('data-bs-theme', 'dark');
            localStorage.setItem('bsTheme', 'dark');
            document.getElementById('switch').innerHTML = 'Dark';
            document.getElementById("design").className = 'design dark-mode';
        } else {
            htmlElement.setAttribute('data-bs-theme', 'light');
            localStorage.setItem('bsTheme', 'light');
            document.getElementById('switch').innerHTML = 'Light';
        }
    });
});
 









