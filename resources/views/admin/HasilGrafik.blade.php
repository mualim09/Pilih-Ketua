@extends('admin.Template')
@section('title')
    Hasil Pemilihan | Kilat
@endsection
@section('body')
  <script>
  $(document).ready(function() {
      $("li").removeClass('active');
  $("#hasil_grafik").addClass('active');
  $("#bar").addClass('active');
  $("#parent_hasil").addClass('active');
  });
  </script>
<script src="/js/Chart.js"></script>
<style>
  td {
    padding: 5px;
    font-size:16px;
    font-family: helvetica
  }
  #perolehanSuara {
    margin-top: 125px;
  }
  .hasil {
    top:15px;
    display: inline-block;
    width:20px;
    height: 20px;
  }
  .box1 {
    background: rgba(255, 99, 132, 0.2);
    border:2px solid rgba(255,99,132,1);
  }
  .box2 {
    background: rgba(54, 162, 235, 0.2);
    border:2px solid rgba(54, 162, 235, 1);
  }
  .box3 {
    background:rgba(153, 102, 255, 0.2);
    border:2px solid rgba(153, 102, 255, 1);
  }

  @media print {
    button,.btn,footer,.main-footer,.nav,.nav-tabs {
      display:none;
    }
    body {
      border-top: none;
    }
  }
</style>

<div id="hasilGrafik">
      <div class="row">
        <!-- Left col -->
        <section class="col-md-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li id="bar"><a href="#revenue-chart" data-toggle="tab">Batang</a></li>
              <li id="circle"><a href="#sales-chart" data-toggle="tab">Lingkaran</a></li>
              <li class="pull-left header"><i class="fa fa-bar-chart fa-2x"></i> <h3 style="display: inline;">Grafik hasil perhitungan pemilihan kandidat kilat</h3></li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; min-height: 400px;">
                  <div class="row">
                    <div style="height: 300px" class="col-md-8">
                    <grafikbar></grafikbar>
                  </div>
                  <div class="col-md-4">
                    <result></result>
                  </div>
                  </div>
              </div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative;min-height:400px">
                  <div style="height: 300px" class="col-md-8">
                    <grafikpie></grafikpie>
                  </div>
                   <div class="col-md-4">
                    <result></result>
                  </div>
              </div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
</section>
</div>
<button class="btn btn-default btn-flat" style="font-family:helvetica" onclick="location.reload()">Refresh</button>
<button class="btn btn-info btn-flat pull-right" style="font-family: helvetica" onclick="window.print()">Print</button>

</div>


<template id="result">
    <table id="perolehanSuara">
      <tr>
        <td><span class="hasil box1"></span></td>
        <td>No. 1</td>
        <td>= @{{ persen[0] }}% (@{{ hasil[0] }} Suara)</td>
      </tr>
      <tr>
        <td><span class="hasil box2"></span></td>
        <td>No. 2</td>
        <td>= @{{ persen[1] }}% (@{{ hasil[1] }} Suara)</td>
      </tr>
      <tr>
        <td><span class="hasil box3"></span></td>
        <td>No. 3</td>
        <td>= @{{ persen[2] }}% (@{{ hasil[2] }} Suara)</td>
      </tr>
    </table>

</template>













<script>

Vue.component("result",{
  template:'#result',
  data:function() {
    return {
      hasil:[],
      persen:[]
      }
  },
  mounted() {
        axios.get('{{ route('kandidat.suara') }}').then(response => {
          this.hasil = response.data
        });        
        axios.get('{{ route('kandidat.persenSuara') }}').then(response => {
          this.persen=response.data
        });

  }
});



Vue.component("grafikbar",{
  template:'<canvas id="myChart"></canvas>',
  data:function() {
    return {
          hasil:[]
    }

  },
  methods:{
    draw:function() {
    axios.get('{{ route('kandidat.suara') }}').then(response => {
    this.hasil=response.data

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Kandidat No. 1", "Kandidat No. 2", "Kandidat No. 3"],
        datasets: [{
          label: 'Jumlah suara ',
          data: this.hasil,
          backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)'
          ],
          borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(153, 102, 255, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
    //end chart
});

    }
  },
  mounted() {
    this.draw()
  }
})

Vue.component("grafikpie",{
  template:'<canvas id="myChart2"></canvas>',
  data:function() {
    return {
          hasil:[]
    }

  },
  methods:{
    draw:function() {
    axios.get('{{ route('kandidat.suara') }}').then(response => {
    this.hasil=response.data

    var ctx = document.getElementById("myChart2").getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["Kandidat No. 1 ", "Kandidat No. 2 ", "Kandidat No. 3 "],
      datasets: [{
        label: '',
        data: this.hasil,
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)'
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(153, 102, 255, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
    //end chart
});
    }
  },
  mounted() {
    this.draw()
  }
})


    var HasilGrafik = new Vue({
      el:'#hasilGrafik',
      data:{

      },
      methods:{
      }
    })


    
  </script>







<script>
var myApp = new Vue({
  el:'#myApp',
  data:{
    no:'',
    nama:'',
    suara:''
  },
  created() {
    this.getSuaraTerbanyak()
  },
  methods:{
    getSuaraTerbanyak:function() {
      axios.get('{{ route('suaraTerbanyak') }}').then(response => {
        console.log(response)
        this.no=response.data.suaraTerbanyak[0].no_kandidat
        this.nama=response.data.suaraTerbanyak[0].nama
        this.suara=response.data.jumlahSuara
      })
    }
  }
})

</script>


@endsection
