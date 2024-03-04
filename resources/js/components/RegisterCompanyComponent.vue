<template>
    <div class="container-fluid">
        <div class="row main-content bg-success text-center">
            <div class="col-md-4 text-center company__info">
                <span class="company__logo"><h2><span class="fa fa-android"></span></h2></span>
                <h4 class="company_title"><a class="text-white" href="/" >Multi Tenant</a></h4>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
                    <div class="row">
                        <h2>{{panelTitle}}</h2>
                    </div>
                    <div class="row">
                        <form method="post" :action="postAction" @submit.prevent enctype="multipart/form-data">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="name" v-model="form.name" placeholder="name" aria-label="companyname" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="domain" v-model="form.domain" placeholder="domain"  aria-label="companyname" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-3">
                                <input type="email" class="form-control" v-model="form.email" placeholder="email" aria-label="Recipient's name" aria-describedby="basic-addon2">
                            </div>

                            <div class="input-group mb-3">
                                <input type="test" class="form-control" v-model="form.url" placeholder="url" aria-label="Recipient's name" aria-describedby="basic-addon2">
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" class="form-control" v-model="form.password" placeholder="password" aria-label="Company Password" aria-describedby="basic-addon2">
                            </div>

                            <label for="basic-url" class="form-label">Logo</label>
                            <div class="input-group mb-3">
                                <input type="file" @change="onImageChange" class="form-control" placeholder="url" aria-label="Recipient's name" aria-describedby="basic-addon2">
                            </div>

                            <div class="input-group mb-3">
                                <input type="submit" value="submit" class="btn btn-primary" @click="submit()">
                            </div>
                            
                        </form>
                    </div>
                    <!-- <div class="row">
                        <p>{{baseLinkName}} <a :href="baseLink">Login </a></p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'CompanyRegisterComponent',
    props:{
        panelTitle:{
            default:'login',
            type:String,
            required:true
        },
        postAction:{
            type:String,
            required:true
        },
        baseLink:{
            type:String
        },
        baseLinkName:{
            type:String
        }
    },

    data(){
        return{
            form:{
                email:'',
                name:'',
                url:'',
                logo_path:'',
                password:'',
                domain:''
            },
            hasFile:false,

        }
    },

    created(){
        
    },

    methods: {
         onImageChange(e){
            console.log(e.target.files[0]);
            this.form.logo_path = e.target.files[0];
            this.hasFile = true;
        },
        submit(){
            let formData = new FormData();
            if(this.hasFile){
                formData.append("logo_path", this.form.logo_path);
                formData.append("name",this.form.name);
                formData.append("email",this.form.email);
                formData.append("url",this.form.url);
                formData.append("password",this.form.password);
                formData.append("domain",this.form.domain);
            }
            axios.post(this.postAction, (this.hasFile ? formData : this.form))
            .then(res => {
                if (res.data.success) {
                    toastr.success(res.data.message);
                } else {
                    toastr.warning(res.data.message);
                }
            })
            .catch(err => {
                if(err.response && err.response.status === 422){
                    //alert('ki')
                    toastr.error(err.response.data.message)
                }else{
                    toastr.error("An error occured, please try again")
                    console.log(err);
                }
            });
        }
    }


}
</script>