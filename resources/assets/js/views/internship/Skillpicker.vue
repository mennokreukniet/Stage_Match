<template>
    <div>
        <input v-model="searchSkill" />
        <div v-for="skill in searchedSkills" :key="skill.id" class="skill">

            <button class="classic" style="display:block;margin-bottom: 5px;" @click="addSkill(skill)">{{skill.name}}</button>

        </div>

        <span class="title2 margin-top">My Skills</span>
        <div class="skills">

            <div v-if="value" class="neutral">There are no skills, add one!</div>

            <template v-for="(skill, index) in value">
                <div v-bind:key="skill.id" class="skill settings">
                    <span>{{skill.name}}</span>

                    <button type="button" @click="updateLevel(index, 1)" v-bind:class="{ selected: skill.level == '1' }" class="classic good">
                        Good
                    </button>
                    <button type="button" @click="updateLevel(index, 2)" v-bind:class="{ selected: skill.level == '2' }" class="classic expert">
                        Expert
                    </button>
                    <input type="checkbox" name="Mandatory" v-model="skill.mandatory">
                    <button type="button" v-on:click="deleteSkill">

                        Delete
                    </button>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    import Http from '../../core/http';
    export default {
        name: "Skillpicker",
        props: {
            value: {
                type: Array,
                default: () => []
            },
        }, //skills
        data(){
            return {
                searchSkill: "",
                searchedSkills: [],
                checked: false,
            }
        },
        watch: {
            searchSkill: function (value) {
                new Http().get(`skill/${value}`).then(res => {
                    this.searchedSkills = res.data.result;

                });
            }
        },
        methods: {

            update() {
                this.$emit('input', this.value);
            },
            updateLevel(index, i) {
                this.value[index].level = i;

            },
            deleteSkill(index){

                this.value.splice(index, 1);
                this.update();
            },
            addSkill(skill){
                this.value.push(skill);
                this.update();

            }
        }
    }
</script>
