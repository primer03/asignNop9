<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/report.css">
    <title>Document</title>
</head>

<body>
    <div class="card" id="simple_table">
        <table id="simple_table">
            <thead id="thd">
            </thead>
            <tbody id="tbo">
            </tbody>
        </table>
    </div>
    <!-- <input type="button" onclick="generate()" value="Export To PDF" /> -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
<script>
    var tbos = document.getElementById('tbo')
    var thd = document.getElementById('thd')
    var theaxd = null;
    var arrdata = [];

    window.onload = async() => {
        try {
            const resx = await fetch('../php/rest.php?dataseries', {
                method: 'GET'
            })
            if (resx.ok) {
                const datax = await resx.json();
                var dsx = datax.filter((e)=>{
                    return e.kamen_era != 'Heisei'
                })
                console.log(dsx);
                console.log(Object.keys(datax[0]));
                console.log(Object.values(datax[0]));
                let keyxd = Object.keys(datax[0]);
                theaxd = keyxd
                for (const key in keyxd) {
                    var th = document.createElement('th')
                    th.innerHTML = keyxd[key]
                    thd.appendChild(th)
                }
                var th = document.createElement('th')
                th.innerHTML = 'แก้ไข'
                thd.appendChild(th)
                var th = document.createElement('th')
                th.innerHTML = 'ลบ'
                thd.appendChild(th)
                for (const key in datax) {
                    arrdata.push(Object.values(datax[key]))
                    var tr = document.createElement('tr')
                    tbos.appendChild(tr)
                    for (const key1 in datax[key]) {
                        var td = document.createElement('td')
                        td.innerHTML = datax[key][key1]
                        tr.appendChild(td)
                    }
                    var td = document.createElement('td')
                    td.innerHTML = '<a class="btnedit" href="">แก้ไข</a>'
                    tr.appendChild(td)
                    var td = document.createElement('td')
                    td.innerHTML = '<a class="btndelete" href="">ลบ</a>'
                    tr.appendChild(td)
                }
                console.log(arrdata);
            } else {
                throw new Error(resx.status)
            }
        } catch (ex) {
            console.log(ex.message);
        }
    }

    function generate() {
        let doc = new jsPDF()

        doc.autoTable({
            head: [
                theaxd
            ],
            body: arrdata,
            // headerStyles: {
            //     lineWidth: 2,
            // }
        })
        doc.save("output.pdf")
    }
</script>

</html>