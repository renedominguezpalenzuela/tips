  //if(typeof jsPDF !== 'undefined')
  //{
    var specialElementHandlers =
    {
        '.no-export': function (element, renderer)
        {
            return true;
        }
    };

    function exportPDF(id)
    {
        var source = document.getElementById(id);

        var divContents = document.getElementById(id).innerHTML;
        var a = window.open('', '', 'height=500, width=500');
        a.document.write('<html>');
        a.document.write('<body>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();

/*
        html2canvas(source,
        {
          logging: true,
          useCORS: true,
          allowTaint: true,
          scale: 4,
          backgroundColor: '#FFFFFF',
          background: '#FFFFFF',
        }).then((canvas) =>
        {
            var img = canvas.toDataURL('image/jpeg', 1);
            var doc = new jsPDF('p', 'pt', 'a4');

            doc.addImage(img, 'JPEG');
            doc.save('test.pdf');        
        });
*/
    }
  //}