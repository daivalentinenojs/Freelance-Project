function KomaJual(param){
  var sum = param.value;
  var id = param.id;
  var nilai=$("#"+id).val();
  if (nilai!="")
  {
    var nilaic=nilai.replace(",","");

    var pcheck=parseFloat(nilaic.replace(/,/g, "")).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //console.log(pcheck);
    $("#"+id).val(pcheck);
   $("#"+id+"_S").val(nilaic);
  }

//$("#"+id+"_s").val();
  /*
  var nomor = id.split('Harga');

  sum=sum.replace(",", "");

  if(sum!= 0){
    sums = parseFloat(sum.replace(/,/g, "")).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#Harga'+nomor[1]).val(sums);
    $('#hargajual'+nomor[1]).val(sums.replace(/,/g, ""));
  }*/
}


function KomaJual2(nilai){
  var pcheck="";
  if (nilai!="")
  {
    var nilaic=nilai.replace(",","");
    pcheck=parseFloat(nilaic.replace(/,/g, "")).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
  return pcheck;

//$("#"+id+"_s").val();
  /*
  var nomor = id.split('Harga');

  sum=sum.replace(",", "");

  if(sum!= 0){
    sums = parseFloat(sum.replace(/,/g, "")).toFixed(0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#Harga'+nomor[1]).val(sums);
    $('#hargajual'+nomor[1]).val(sums.replace(/,/g, ""));
  }*/
}
