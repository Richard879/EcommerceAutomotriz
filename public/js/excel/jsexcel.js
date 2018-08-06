var X = XLSX;   

   

function fixdata(data)

{

       var o = "";

       var l = 0;

       var w = 10240;

       

       for (; l < data.byteLength / w; ++l)

       {

               o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w, l * w + w)));

       }

       

       o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w)));

       return o;

}

function to_json(workbook)

{

       var result = {};

       workbook.SheetNames.forEach(function(sheetName) {

               var roa = X.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);

               if(roa.length > 0)

                       result[sheetName] = roa;

       });

       

       return result;

}

   

function process_wb(wb)   

{   

       var output = "";   

       output = JSON.stringify(to_json(wb), 2, 2);   

           

       var excelData_array = to_json(wb);   

           

       if (excelData_array['Sheet 1'])

       {   

               for (var i = 0; i < excelData_array['Sheet 1'].length; i++)   

               {   

                       var column_1 = excelData_array['Sheet 1'][i]['Name of user'];   

                       var column_2 = excelData_array['Sheet 1'][i]['Role'];   

                       var column_3 = excelData_array['Sheet 1'][i]['Email'];   

               }   

       }   

       else   

               alert("Cannot determine the contents of the file specified.\rEither there were no users listed in the columns,\ror the file is not valid.\r\nError [07072016]");   

   

               var out = document.getElementById('out');

       if (out.innerText === undefined)

               out.textContent = output;   

       else   

               out.innerText = output;   

}

function handleFile(e)

{

       var files = e.target.files;

       var f = files[0];

       {

               var reader = new FileReader();

               var name = f.name;

               reader.onload = function(e) {

                       var data = e.target.result;

                       var arr = fixdata(data);

                       var wb = X.read(btoa(arr), {type: 'base64'});

                       process_wb(wb);

               };

               

               reader.readAsArrayBuffer(f);

       }

}

function importarExcel(){
    //alert('holaaa');
    var xlf = document.getElementById('xlf');
    xlf.addEventListener('change', handleFile, false);
}

var btnProcesa = document.getElementById('btnProcesa');

if (btnProcesa.addEventListener)
{
    btnProcesa.addEventListener('click', importarExcel, false);
}
/*
glyphs.addEventListener('click', function(event) {
        if (event.target.tagName === 'INPUT') {
          return event.target.select();
        }
      });
      */