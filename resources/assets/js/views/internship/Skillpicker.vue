<template>
    <div>
        <input v-model="searchSkill" />
        <div v-for="skill in searchedSkills" :key="skill.id" class="skill">
            <a class="classic" style="display:block;margin-bottom: 5px;" @click="$emit('skillAdded', skill.id)">{{skill.name}}</a>
        </div>

        <span class="title2 margin-top">My Skills</span>
        <div class="skills">
            <div v-if="skills" class="neutral">There are no skills, add one!</div>
            <template v-for="(skill, index) in skills">
                <div v-bind:key="skill.id" class="skill settings">
                    <span>{{skill.name}}</span>
                    <a @click="$emit('setLevel', skill.id, 2)" v-bind:disabled="skill.pivot.level == '2'" v-bind:class="{ selected: skill.pivot.level == '2' }" class="classic good">
                        Good
                    </a>
                    <a @click="$emit('setLevel', skill.id, 3)" v-bind:disabled="skill.pivot.level == '3'" v-bind:class="{ selected: skill.pivot.level == '3' }" class="classic expert">
                        Expert
                    </a>
                    <input type="checkbox" name="Mandatory" v-bind:disabled="skill.pivot.mandatory == ''" v-bind:class="{ selected: skill.pivot.level == '3' }" v-on:click="set_level(index, skill.id, 2)">
                    <a v-on:click="$emit('delete', skill.id, index)">
                        Delete
                    </a>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    import Http from '../../core/http';
    export default {
        name: "Skillpicker",
        props: ['skills'],
        data(){
            return {
                searchSkill: "",
                searchedSkills: []
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
            set_level(index, id, level) {
                new Http().post("internship/skill/level", { skill_id: id, internship_id: this.internship.id, level: level}).then(res => {
                    this.skills[index].pivot.level = level;
                })
            }
        }
    }
</script>

<style scoped>

</style>