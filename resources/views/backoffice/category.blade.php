<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th align="center">
                <h3> {{ $profile['username'] }} </h3>
            </th>
            <th>
                <a href="{{ URL('admin') }}"> home </a> > 
                <a href="{{ URL('admin/logout') }}"> logout </a>
            </th>
        </tr>
        <tr>
            <th colspan="2" align="center">
                เพิ่มหมวดหมู่ใหม่ | Add New Category
            </th>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <form action="{{ URL('admin/addCategory') }}" method="post">
                    <table>
                        @if($errors->any())
                            <tr>
                                <td colspan="2" align="center" border="1">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td>
                                <strong> CategoryName </strong>
                            </td>
                            <td>
                                <input type="text" name="CategoryName" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong> CategoryNameEN </strong>
                            </td>
                            <td>
                                <input type="text" name="CategoryNameEN" > <br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong> SubCategoryName </strong>
                            </td>
                            <td>
                                <input type="text" name="SubCategoryName[]" required>
                                <div id="elSubCategoryName"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong> SubCategoryNameEN </strong>
                            </td>
                            <td>
                                <input type="text" name="SubCategoryNameEN[]" > <br>
                                <div id="elSubCategoryNameEN"></div>
                            </td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td align="center">
                                <a href="#" onclick="formElement()"> addSubCategory </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                @csrf
                                <button type="submit" name="button" value="1"> Save </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
        @if(count($category)>0)
            <tr>
                <td colspan="2" align="center">
                    <table>
                        @foreach ($category as $item)
                            <tr>
                                <th>
                                    <strong> {!! $item['categoryID'] !!} </strong>
                                </th>
                                <td>
                                    <strong> CategoryName </strong> <br>
                                    <span id="textCategoryName{!! $item['categoryID'] !!}"> {{ $item['categoryName'] }} </span> <br>
                                    <input type="text" id="CategoryName{!! $item['categoryID'] !!}" name="CategoryName" value="{!! $item['categoryName'] !!}" style="display: none;"> <br>
                                    <strong> CategoryNameEN </strong> <br>
                                    <span id="textCategoryNameEN{!! $item['categoryID'] !!}"> {{ $item['categoryNameEN'] }} </span> <br>
                                    <input type="text" id="CategoryNameEN{!! $item['categoryID'] !!}" name="CategoryNameEN" value="{!! $item['categoryNameEN'] !!}" style="display: none;"> <br>
                                </td>
                                <td>
                                    @if(count($item['subCategory'])>0)
                                        <table>
                                            @foreach ($item['subCategory'] as $item2)
                                                <tr>
                                                    <td>
                                                        <strong> SubCategoryName </strong> <br>
                                                        <span id="textSubCategoryName{!! $item['categoryID'] !!}"> {{ $item2['subCategoryName'] }} </span> <br>
                                                        <input type="text" id="SubCategoryName{!! $item['categoryID'] !!}" name="SubCategoryName{!! $item['categoryID'] !!}[]" value="{!! $item2['subCategoryName'] !!}" style="display: none;"> <br>
                                                        <div id="elemSubCategoryName{!! $item['categoryID'] !!}" style="display: none;"></div>
                                                        <strong> SubCategoryNameEN </strong> <br>
                                                        <span id="textSubCategoryNameEN{!! $item['categoryID'] !!}"> {{ $item2['subCategoryName'] }} </span> <br>
                                                        <input type="text" id="SubCategoryNameEN{!! $item['categoryID'] !!}" name="SubCategoryNameEN{!! $item['categoryID'] !!}[]" value="{!! $item2['subCategoryNameEN'] !!}" style="display: none;"> <br>
                                                        <div id="elemSubCategoryNameEN{!! $item['categoryID'] !!}" style="display: none;"></div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <strong> --- ไม่มีหมวดหมู่ย่อย --- </strong>
                                    @endif    
                                </td>
                                <td>
                                    |
                                    <a href="#" onclick="editCategory({!! $item['categoryID'] !!})"> Edit </a> | 
                                    <a href="#" onclick="deleteCategory({!! $item['categoryID'] !!})"> Delete </a> | 
                                    <a href="#" id="btnClose{!! $item['categoryID'] !!}" onclick="closeCategory({!! $item['categoryID'] !!})" style="display: none;"> Close | </a>
                                    <a href="#" id="btnSave{!! $item['categoryID'] !!}" onclick="saveCategory({!! $item['categoryID'] !!})" style="display: none;"> Save | </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"> </td>
                                <td align="center">
                                    <a href="#" id="btnAddSubCate{!! $item['categoryID'] !!}" onclick="formSectionElement({!! $item['categoryID'] !!})" style="display: none;"> addSubCategory </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $category->links() }}
                </td>
            </tr>
        @else
            <tr>
                <td colspan="2" align="center">
                    <h3> ไม่มีข้อมูล </h3>
                </td>
            </tr>
        @endif
    </table>
    <script>
        function editCategory(cate) {
            console.log("edit "+cate);
            document.getElementById("textCategoryName"+cate).style.display = "none";
            document.getElementById("CategoryName"+cate).style.display = "block";
            document.getElementById("textCategoryNameEN"+cate).style.display = "none";
            document.getElementById("CategoryNameEN"+cate).style.display = "block";
            document.getElementById("textSubCategoryName"+cate).style.display = "none";
            document.getElementById("SubCategoryName"+cate).style.display = "block";
            document.getElementById("textSubCategoryNameEN"+cate).style.display = "none";
            document.getElementById("SubCategoryNameEN"+cate).style.display = "block";
            document.getElementById("elemSubCategoryName"+cate).style.display = "block";
            document.getElementById("elemSubCategoryNameEN"+cate).style.display = "block";
            document.getElementById("btnAddSubCate"+cate).style.display = "block";
            document.getElementById("btnClose"+cate).style.display = "block";
            document.getElementById("btnSave"+cate).style.display = "block";
        }
        function closeCategory(cate) {
            console.log("close "+cate);
            document.getElementById("textCategoryName"+cate).style.display = "block";
            document.getElementById("CategoryName"+cate).style.display = "none";
            document.getElementById("textCategoryNameEN"+cate).style.display = "block";
            document.getElementById("CategoryNameEN"+cate).style.display = "none";
            document.getElementById("textSubCategoryName"+cate).style.display = "block";
            document.getElementById("SubCategoryName"+cate).style.display = "none";
            document.getElementById("textSubCategoryNameEN"+cate).style.display = "block";
            document.getElementById("SubCategoryNameEN"+cate).style.display = "none";
            document.getElementById("elemSubCategoryName"+cate).style.display = "none";
            document.getElementById("elemSubCategoryNameEN"+cate).style.display = "none";
            document.getElementById("btnAddSubCate"+cate).style.display = "none";
            document.getElementById("btnClose"+cate).style.display = "none";
            document.getElementById("btnSave"+cate).style.display = "none";
        }
        function deleteCategory(cate) {
            if(confirm("Are you sure delete this Category ?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                       // Typical action to be performed when the document is ready:
                       alert(xhttp.responseText);
                    }
                };
                xhttp.open("POST", "{{ URL('admin/category/delete') }}", true);
                xhttp.send();
            }
        }
        function saveCategory(cate) {
            console.log("save "+cate);
        }
        var fileId = 0;
        function formElement() {
            fileId++;
            var subCate = '<input type="text" name="SubCategoryName[]" /> ' +
                       '<a href="#" onclick="removeElement(sub'+fileId+',subEN'+fileId+')">Remove</a>';
            var subCateEN = '<input type="text" name="SubCategoryNameEN[]" /> ' +
                       '<a href="#" onclick="removeElement(sub'+fileId+',subEN'+fileId+')">Remove</a>';
            addElement('elSubCategoryName','elSubCategoryNameEN', 'div', 'sub' + fileId, 'subEN' + fileId, subCate, subCateEN);
        }
        function addElement(parentId1, parentId2, elementTag, elementId1, elementId2, html1, html2) {
            // Adds an element to the document
            var p1 = document.getElementById(parentId1);
            var newElement1 = document.createElement(elementTag);
            newElement1.setAttribute('id', elementId1);
            newElement1.innerHTML = html1;
            p1.appendChild(newElement1);

            var p2 = document.getElementById(parentId2);
            var newElement2 = document.createElement(elementTag);
            newElement2.setAttribute('id', elementId2);
            newElement2.innerHTML = html2;
            p2.appendChild(newElement2);
        }
        function removeElement(elementId1, elementId2) {
            // Removes an element from the document
            console.log(elementId1,"elementId1");
            console.log(elementId2,"elementId2");
            var element1 = document.getElementById(elementId1.id);
            var element2 = document.getElementById(elementId2.id);
            element1.parentNode.removeChild(element1);
            element2.parentNode.removeChild(element2);
        }
        function formSectionElement(cate) {
            var fileId1 = document.getElementById("elemSubCategoryName"+cate).childElementCount+1;
            var fileId2 = document.getElementById("elemSubCategoryNameEN"+cate).childElementCount+1;
            if(fileId1==fileId2) {
                var subCate = '<input type="text" id="SubCategoryName'+cate+'" name="SubCategoryName'+cate+'[]" /> ' +
                       '<a href="#" onclick="removeSectionElement('+cate.toString()+'sub'+fileId1.toString()+','+cate.toString()+'subEN'+fileId1.toString()+')">Remove</a>';
                var subCateEN = '<input type="text" id="SubCategoryNameEN'+cate+'" name="SubCategoryNameEN'+cate+'[]" /> ' +
                           '<a href="#" onclick="removeSectionElement('+cate.toString()+'sub'+fileId1.toString()+','+cate.toString()+'subEN'+fileId1.toString()+')">Remove</a>';
                addSectionElement('elemSubCategoryName'+cate,'elemSubCategoryNameEN'+cate, 'div', cate.toString() + 'sub' + fileId1, cate.toString() + 'subEN' + fileId1, subCate, subCateEN);
            }else{
                alert("something went wrong, please try again !!!");
                console.log(fileId1+" "+fileId2);   
            }
        }
        function addSectionElement(parentId1, parentId2, elementTag, elementId1, elementId2, html1, html2) {
            // Adds an element to the document
            var p1 = document.getElementById(parentId1);
            var newElement1 = document.createElement(elementTag);
            newElement1.setAttribute('id', elementId1);
            newElement1.innerHTML = html1;
            p1.appendChild(newElement1);

            var p2 = document.getElementById(parentId2);
            var newElement2 = document.createElement(elementTag);
            newElement2.setAttribute('id', elementId2);
            newElement2.innerHTML = html2;
            p2.appendChild(newElement2);
        }
        function removeSectionElement(elementId1, elementId2) {
            // Removes an element from the document
            console.log(elementId1,"SectionElementId1");
            console.log(elementId2,"SectionElementId2");
            var element1 = document.getElementById(elementId1.id);
            var element2 = document.getElementById(elementId2.id);
            element1.parentNode.removeChild(element1);
            element2.parentNode.removeChild(element2);
        }
    </script>
</body>
</html>