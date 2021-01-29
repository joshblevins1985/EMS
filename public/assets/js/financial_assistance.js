

Vue.component('form-validation', {

    template: `

<div class="wizard-container">
     <!-- begin wizard-form -->
<form :action="this.myaction" method="POST" name="form-wizard" class="form-control-with-bg" data-parsley-validate="true">
    <!-- begin wizard -->
    <div id="wizard">
        <!-- begin wizard-step -->
        <ul>
        
            
            <li v-for="step in steps">
                <a :href="step.href">
                    <span class="number">1</span>
                    <span class="info">
                        {{ step.name }}
                    </span>
                </a>
            </li>
            
        </ul>
        <!-- end wizard-step -->
        <!-- begin wizard-content -->
        <div class="wizard-content">
            <!-- begin step-1 -->
            <slot></slot>            
        </div>
        <!-- end wizard-content -->
    </div>
    <!-- end wizard -->
</form>
<!-- end wizard-form -->    
</div>
   
    `,

    props:{
        myaction: {requirre: true}
    },

    data() {
        return { steps: []}
    },

    created() {

        this.steps = this.$children;

        console.log(this.$children);
    },
    computed: {
        action(){
            return this.action;
        }
    }

});

Vue.component('step',{

    template: `
    
    <div :id="this.id">
        <slot></slot>
    </div>
    
    `,

    props: {

        name: { require: true },
        id: { require: true }

    },

    computed: {

        href(){
            return '#' +  this.id;
        }

    }

});



new Vue({
    el: '#app',
});