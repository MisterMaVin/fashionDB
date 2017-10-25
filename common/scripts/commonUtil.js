function fnCommonValidate(validateDomNameArray, formName) {
  var vaildateDomName = null;

  for (var k = 0; k < validateDomNameArray.length; k++)
  {
    vaildateDomName = validateDomNameArray[k];
    if ( eval(formName + "." + vaildateDomName + ".value === ''") )
    {
      alert(vaildateDomName + " is essential.");
      return false;
    }
  }
  return true;
}
function fnSubmit(formName) {
  if ( fnValidate(formName) )
  {
    eval(formName + ".submit()");
  }
}
function fnApply(formName) {
  eval(formName + ".isApply.value = \"true\"");
  fnSubmit(formName);
}
function fnDrawChildSelectbox(obj, inputName, url, value, display, formName) {
  // 1. obj가 selectbox 중 몇번째 index인지 구하기
  var index = $("select." + inputName).index(obj);

  // 2. index보다 큰 selectbox 제거
  $("select." + inputName + ":gt(" + index + ")").each(function(){
    $(this).remove();
  });

  // 3. 입력값이 있을 때만 하위 부모 코드 조회
  var parent_code = $("select." + inputName + ":last").val();
  if ( parent_code !== "" )
  {
    $.ajax({
      url: url,
      type: "post",
      data: {"parent_code": parent_code}
    }).done(function(data) {
      // 4. json_encode로 encoding된 값을 parsing하기
      var parsedData = JSON.parse(data);
      var appendHTML = "<select class=\"" + inputName + "\" onchange=\"fnDrawChildSelectbox(this, '" + inputName + "', '" + url + "', '" + value + "', '" + display + "', '" + formName + "')\">";
      appendHTML += "<option>&nbsp;</option>";
      var row = null;

      for (var k = 0; k < parsedData.length; k++)
      {
        row = parsedData[k];
        appendHTML += "<option value=\"" + row[value] + "\">";
        appendHTML += row[display];
        appendHTML += "</option>";
      }

      appendHTML += "</select>";

      // 5. 화면에 rendering하기
      $("td.appended").append(appendHTML);
    });
  }
  else
  {
    if ( index > 0 )
    {
      parent_code = $("select." + inputName + ":eq(" + (index - 1) + ")").val();
    }
    else
    {
      parent_code = "";
    }
  }
  eval( formName + "." + inputName + ".value = \"" + parent_code + "\"");
}
