<template>
    <div>
    <div class="card">
        <div class="card-header">
            <strong>Generate</strong> Certificate</div>
        <div class="card-body">
            <form @submit.prevent="getCertificate" method="post">
                <div class="form-group">
                    <label for="nf-email">Attempt ID</label>
                    <input v-model="attemptID" class="form-control" id="nf-email" type="number" placeholder="Enter attempt ID">
<!--                    <span class="help-block">Please enter your email</span>-->
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" @click="getCertificate" type="submit">
                <i class="fa fa-dot-circle-o"></i> Submit</button>
            <button class="btn btn-sm btn-danger" type="reset">
                <i class="fa fa-ban"></i> Reset</button>
        </div>
    </div>
        <div class="loader-box"><div id="load" class="loader"></div></div>
    </div>
</template>

<script>
    export default {
        name: "GenrateCertificate",
        data(){
            return{
                attemptID:'',
            }
        },
        methods:{
            getCertificate()
            {
                $('#load').show();
                axios.post('/api/admin/action/generateCertificate',{attemptID: this.$data.attemptID})
                    .then(response=>{$('#load').hide();})
                    .catch((res,data)=>{swal.fire('Error Genrating Certificate','Reason: '+res.response.data.message,'error');$('#load').hide();})
            }
        },
        mounted(){
            $('#load').hide();
        }
    }
</script>

<style scoped>
    .loader-box{
        position:fixed;
        margin: auto;
        width: 50%;
        height:50%;
    }
    .loader{
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
