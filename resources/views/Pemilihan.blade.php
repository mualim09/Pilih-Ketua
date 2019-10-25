@extends('Template')
@section('title')
    Pemilihan Ketua Kilat | SMK Negeri 3 Jepara
@endsection
@section('body')
<link rel="stylesheet" href="css/bulma.css">
<link rel="stylesheet" href="css/pemilihan.css">
<style>
    
.loader{
    border:3px solid #ccc;
    width:200px;
    height:200px;
    border-radius:50%; 
    border-left-color: transparent;
  border-right-color: transparent;
    animation:rotate 2s cubic-bezier(0.26, 1.36, 0.74,-0.29) infinite;
}
#loader2{
    border:3px solid #3bc9db;
    width:220px;
    height:220px;
    position:relative;
    top:-210px;
    border-left-color: transparent;
  border-right-color: transparent;
    animation:rotate2 2s cubic-bezier(0.26, 1.36, 0.74,-0.29) infinite;
}
#loader3{
    border:3px solid #d6336c;
    width:240px;
    height:240px;
    position:relative;
    top:-452px;
    border-left-color: transparent;
  border-right-color: transparent;
    animation:rotate 2s cubic-bezier(0.26, 1.36, 0.74,-0.29) infinite;
}
#loader4{
    border:3px solid #3bc9db;
    width:260px;
    height:260px;
    position:relative;
    top:-708px;
    border-left-color: transparent;
  border-right-color: transparent;
    animation:rotate2 2s cubic-bezier(0.26, 1.36, 0.74,-0.29) infinite;
}
@keyframes rotate{
    0%{transform:rotateZ(-360deg)scale(0.7)}
    100%{transform:rotateZ(0deg)scale(0.7)}
}
@keyframes rotate2{
    100%{transform:rotateZ(0deg)scale(0.7)}
    0%{transform:rotateZ(360deg)scale(0.7)}
}
#text{
    color:#aaa;
    font-family:Arial;
    font-size:20px;
    position:relative;
    top:115px
}
.off {
    text-align: center;
    font-family: helvetica;
}
.off img {
    width:100%;
}
</style>

<div class="container" id="pemilihanApp">
            <kandidat></kandidat>
</div>
       


<template id="kandidat">
        <div class="root">
                <div v-if="loading">
                    <center><br><br><br>
                        <span id="text">LOADING...</span><br>

                        <div class="loader" id="loader"></div>
                        <div class="loader" id="loader2"></div>
                            <!--Delete the "loader3" and "loader4" divs for a 2-layer loader-->
                            <!--You can also change the animation durations or delays, that looks also pretty cool -->
                  </div>
                  <div v-if="!loading">
        <div v-if="status">
        <div class="col-md-4 kandidat fadeInLeft" v-for="k in kandidats">
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-light-blue">
                            <h4 class="widget-user-username" style="font-size:18px;font-weight:bold">Ketua : @{{ k.nama.split(',')[0] }}</h4>
                            <h4 class="widget-user-desc" style="font-size:14px">Wakil : @{{ k.nama.split(',')[1] }}</h4>
                            <br> <br> <br>
                            <h5 class="widget-user-desc">@{{ k.kelas }}</h5>
                    </div>
                    <div class="widget-user-image">
                            <img class="img-circle" :src="'/uploads/'+k.foto.split(',')[0]">
                            <img class="img-circle" :src="'/uploads/'+k.foto.split(',')[1]">
                        </div>
                    <div class="box-footer">
                      <div class="row">
                            <div class="col-md-12">
                                <tabs class="is-centered">
                                    <tab name="VISI" :selected="true">
                                      <p style="word"><textarea  cols="50" rows="10" disabled="" style="background-color: #fff;border:none">@{{ k.visi }}</textarea></p>
                                    </tab>
                                    <tab name="MISI" class="is-centered">
                                      <p style="word"></p><textarea  cols="50" rows="7" disabled="" style="background-color: #fff;border:none">@{{ k.misi }}</textarea></p>
                                    </tab>
                                </tabs>
                                <hr>
        
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="button is-danger" style="padding:10px" v-on:click="pilih(k.no_kandidat)">PILIH</button>
                            </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                  </div>
                  <!-- /.widget-user -->
        </div>
        </div>
                  <div v-if="!status">
                        <div class="off col-md-4 col-md-offset-4">
<img src="/images/closed.jpg" alt="closed">
                            <h3>Maaf, Pemilihan ketua KILAT<br>sudah ditutup !</h3>
                            <button class="button is-danger" style="padding:5px" v-on:click="checkActive">Refresh</button>
                        </div>
                    </div>

                  </div>
            </div>
                <!-- /.root -->
        </template>

<script>
Vue.component('kandidat',{
    template:'#kandidat',
    data:function() {
        return {
            kandidats:[

            ],
            visi:true,
            loading:false,
            status:false

                }
    },
    created() {
        this.checkActive()
        this.getKandidats()
    },
    methods:{
        pilih:function(k) {
        let data =
            {
                nama:'{{ Session::get('nama') }}',
                pilihan:k
            };

            swal({
  title: 'Apa kamu yakin ?',
  html: `Nama : ${data.nama}<br>Pilihan : no ${data.pilihan}`,
  type: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#aaa',
  confirmButtonText: 'Iya aku yakin !',
  cancelButtonText: 'Batal !'
}).then((result) => {
  if (result.value) {

    axios.post('{{ route('user.pilih') }}',{
        nama:data.nama,
        no:k,
        _token: '{{ csrf_token() }}'
    }).then(response => {
            swal({
            title: 'Selesai',
            text: "Terimakasih sudah ikut berpartisipasi",
            type: 'success',
           allowOutsideClick: false,
            showCancelButton: false,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Logout'
            }).then((result) => {
            if (result.value) {
                window.location='{{ route('user.logout') }}'
            }
            })

    });

  }
});
            console.log(data)
        },
        checkActive:function() {
            this.loading=true
            axios.get('{{ route('pemilihan.active') }}').then(response => {
                console.log(response.data.name)
                if(response.data.value==1) {
                    swal(
                        'Login Berhasil !',
                        'Silahkan memilih Calon Ketua Kilat !',
                        'success'
                    )
                    this.status = true
                }
                else {
                    this.status = false
                }
                this.loading=false
            })

        },
        getKandidats:function() {
            this.loading=true
            axios.get('{{ route('kandidat.get') }}').then(response => {
                console.log(response)
                this.kandidats=response.data;
                for(let i = 0;i<this.kandidats.length;i++) {
                    this.kandidats[i].tabs=1;
                }
                this.loading=false
                console.log(this.kandidats)
            })
        },
        changeVisi:function(k) {
            let i = this.kandidats.indexOf(k)
            let selected = this.kandidats[i]
            console.log(selected)
            selected.tabs=1
        },
        changeMisi:function(k) {
            let i = this.kandidats.indexOf(k)
            let selected = this.kandidats[i]
            console.log(selected)
            selected.tabs=0
            console.log(this.kandidats.indexOf(k))
        }
    }
})

Vue.component('tabs', {
    template: `
        <div>
            <div class="tabs">
              <ul>
                <li v-for="tab in tabs" :class="{ 'is-active': tab.isActive }">
                    <a :href="tab.href" @click="selectTab(tab)">@{{ tab.name }}</a>
                </li>
              </ul>
            </div>

            <div class="tabs-details">
                <slot></slot>
            </div>
        </div>
    `,
    
    data() {
        return {tabs: [] };
    },
    
    created() {
        
        this.tabs = this.$children;
        
    },
    methods: {
        selectTab(selectedTab) {
            this.tabs.forEach(tab => {
                tab.isActive = (tab.name == selectedTab.name);
            });
        }
    }
});

Vue.component('tab', {
    
    template: `

        <div v-show="isActive"><slot></slot></div>

    `,
    
    props: {
        name: { required: true },
        selected: { default: false}
    },
    
    data() {
        
        return {
            isActive: false
        };
        
    },
    
    computed: {
        
        href() {
            return '#' + this.name.toLowerCase().replace(/ /g, '-');
        }
    },
    
    mounted() {
        
        this.isActive = this.selected;
        
    }
});


var pemilihanApp = new Vue({
    el:'#pemilihanApp',
    data:{
        loading:false,
    },
    methods:{
        logout:function() {
        swal({
          title: 'Are you sure?',
          text: "All Session will be deleted !",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#D63330',
          cancelButtonColor: '#CBCBCB',
          confirmButtonText: 'Log out!'
        }).then((result) => {
          if (result.value) {
            axios.post('https://pemilihanpmr.herokuapp.com/api/people/logout',{
                accessToken:localStorage.getItem('token')
            })
            localStorage.clear();
            window.location='http://alfin.com/pmr/login.html'
          }
        })
        }
    }
})

</script>
@endsection