<template>
    <form method="post" :action="postAction" @submit.prevent enctype="multipart/form-data">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" v-model="form.name" placeholder="name" aria-label="companyname" aria-describedby="basic-addon1">
        </div>

        <div class="input-group mb-3">
            <input type="email" class="form-control" v-model="form.email" placeholder="email" aria-label="Recipient's name" aria-describedby="basic-addon2">
        </div>

        <label for="basic-url" class="form-label">Url</label>
        <div class="input-group mb-3">
            <input type="test" class="form-control" v-model="form.url" placeholder="url" aria-label="Recipient's name" aria-describedby="basic-addon2">
        </div>

        <label for="basic-url" class="form-label">Logo</label>
        <div class="input-group mb-3">
            <input type="file" @change="onImageChange" class="form-control" placeholder="url" aria-label="Recipient's name" aria-describedby="basic-addon2">
        </div>

        <div class="input-group mb-3">
            <input type="submit" value="submit" class="btn btn-primary" @click="submit()">
        </div>
        
    </form>
</template>

<script>
//import Input from '../../../vendor/laravel/breeze/stubs/inertia/resources/js/Components/Input.vue';
export default {
  //components: { Input },
    name:'EditcompanyComponent',
    props:{
        panelTitle:{
            default:'Edit',
            type:String,
            required:true
        },
        postAction:{
            type:String,
            required:true
        },
        companyId:{
            type:String,
            required: true
        }
        
    },
    data(){
        return{
            company:{},
            form:{
                email:'',
                name:'',
                url:'',
                logo_path:''
            },
            hasFile:false,

        }
    },

    computed:{

    },

    created(){

        //get company
        axios.get('/admin/company/'+this.companyId)
        .then(res=>{
            if (res.data.success) {
                this.company = res.data.company
                this.form.email = this.company.email
                this.form.name = this.company.name
                this.form.url = this.company.url
                this.form.logo_path = this.company.logo_path
            }else{
                 toastr.error(res.data.message);
            }
        })
        .catch(err => {
                toastr.error("An error occured, please try again")
                console.log(err);
        });
    },

    methods: {
        onImageChange(e){
            console.log(e.target.files[0]);
            this.form.logo_path = e.target.files[0];
            this.hasFile = true;
        },
        submit(){
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
                let formData = new FormData();
            if(this.hasFile){
                formData.append("logo_path", this.form.logo_path);
                formData.append("name",'this.form.name');
                formData.append("email",this.form.email);
                formData.append("url",this.form.url);
            }
            
                //console.log(formData.getAll('url'))
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