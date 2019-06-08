	 function submitForm (){

     if (addForm.category.value == "") 
     {
           alert("请填写分类名称");
           addForm.category.focus();
           return false;
      }
     else{
         document.addForm.submit();
     }
 }