<template>
  <div class="container">

      <div v-if="this.role === 'Student'" class="stack">
          <div v-for="(internship, index) in this.internships" :key="index" :class="`position${internships.length - index}`" class="card image elevated">
                <div class="header">
                    <img src="https://www.google.com/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwjJxeWp7avfAhWOalAKHb6bBBcQjRx6BAgBEAU&url=https%3A%2F%2Fwww.entrepreneur.com%2Farticle%2F249174&psig=AOvVaw0EhKHU4Tl0OjJ4g28rOLdJ&ust=1545307540245495">
                </div>
                <div class="content">
                    <div class="font h6 high">{{internship.title}}</div>
                    <div class="font subtitle2 low spacing bottom2">{{internship.distance}} kilometers away</div>
                    <div class="font body1">{{internship.body}}</div>
                    <button v-on:click="move(index)">Set me behind</button>
                </div>
          </div>
      </div>
      <div v-else class="card elevated">
      <!-- <img
        style="margin: -16px;margin-bottom: 16px;width:calc(100% + 32px);border-top-right-radius: 3px; border-top-left-radius: 3px; "
        src="https://assets.entrepreneur.com/content/3x2/2000/20150805204041-google-company-building-corporate.jpeg?width=700&crop=2:1"
      > -->

      <!-- <div>
        <div class="font h6 high">Company name</div>
        <div class="font subtitle2 low">16 kilometers away</div>
        <br>
        <div class="font body1">This is our desc...</div>
      </div> -->

      <strong>Version: </strong><span>V0.0.3 (LESS ALPHA-ISH)</span><br>
      <strong>Role: </strong><span>{{this.role}}</span>
    </div>
  </div>
</template>

<script>
import { runtime } from "../../core/runtime";

export default {
  name: "main_index",
  data() {
    return {
      role: "",
      internships: [
        {
          id: 1,
          company_id: 1,
          title: "Painting Machine Operator",
          mentor: "Ubaldo Stamm",
          body:
            "Eaglet, and several other curious creatures. Alice led the way, was the King; and as the soldiers remaining behind to execute the unfortunate gardeners, who ran to Alice with one eye; 'I seem to dry me at home! Why, I haven't been invited yet.' 'You'll.",
          start_date: "2017-01-14",
          end_date: "2017-05-14",
          created_at: "2018-11-30 11:05:53",
          updated_at: "2018-11-30 11:05:53",
          deleted_at: null,
          matchPoints: 470,
          distance: "12",
          image: null,
          skills: [
            {
              id: 1,
              name: "PHP",
              pivot: {
                internship_id: 1,
                skill_id: 1,
                level: 1
              }
            },
            {
              id: 12,
              name: "Java",
              pivot: {
                internship_id: 1,
                skill_id: 12,
                level: 1
              }
            },
            {
              id: 3,
              name: "JavaScript",
              pivot: {
                internship_id: 1,
                skill_id: 3,
                level: 2
              }
            },
            {
              id: 6,
              name: "Python",
              pivot: {
                internship_id: 1,
                skill_id: 6,
                level: 1
              }
            },
            {
              id: 8,
              name: "C",
              pivot: {
                internship_id: 1,
                skill_id: 8,
                level: 1
              }
            }
          ]
        },
        {
          id: 2,
          company_id: 1,
          title: "Electrical Sales Representative",
          mentor: "Bernie Corwin",
          body:
            "King very decidedly, and there was mouth enough for it flashed across her mind that she was getting so far off). 'Oh, my poor little juror (it was exactly three inches high). 'But I'm NOT a serpent, I tell you!' But she waited for some minutes. Alice.",
          start_date: "2011-06-18",
          end_date: "2011-12-18",
          created_at: "2018-11-30 11:05:53",
          updated_at: "2018-11-30 11:05:53",
          deleted_at: null,
          matchPoints: 450,
          image: null,
          skills: [
            {
              id: 5,
              name: "SQL",
              pivot: { internship_id: 2, skill_id: 5, level: 1 }
            }
          ]
        },
        {
          id: 2,
          company_id: 1,
          title: "Electrical Sales Representative",
          mentor: "Bernie Corwin",
          body:
            "King very decidedly, and there was mouth enough for it flashed across her mind that she was getting so far off). 'Oh, my poor little juror (it was exactly three inches high). 'But I'm NOT a serpent, I tell you!' But she waited for some minutes. Alice.",
          start_date: "2011-06-18",
          end_date: "2011-12-18",
          created_at: "2018-11-30 11:05:53",
          updated_at: "2018-11-30 11:05:53",
          deleted_at: null,
          matchPoints: 450,
          image: null,
          skills: [
            {
              id: 5,
              name: "SQL",
              pivot: { internship_id: 2, skill_id: 5, level: 1 }
            }
          ]
        },
        {
          id: 2,
          company_id: 1,
          title: "Electrical Sales Representative",
          mentor: "Bernie Corwin",
          body:
            "King very decidedly, and there was mouth enough for it flashed across her mind that she was getting so far off). 'Oh, my poor little juror (it was exactly three inches high). 'But I'm NOT a serpent, I tell you!' But she waited for some minutes. Alice.",
          start_date: "2011-06-18",
          end_date: "2011-12-18",
          created_at: "2018-11-30 11:05:53",
          updated_at: "2018-11-30 11:05:53",
          deleted_at: null,
          matchPoints: 450,
          image: null,
          skills: [
            {
              id: 5,
              name: "SQL",
              pivot: { internship_id: 2, skill_id: 5, level: 1 }
            }
          ]
        },
        {
          id: 2,
          company_id: 1,
          title: "Electrical Sales Representative",
          mentor: "Bernie Corwin",
          body:
            "King very decidedly, and there was mouth enough for it flashed across her mind that she was getting so far off). 'Oh, my poor little juror (it was exactly three inches high). 'But I'm NOT a serpent, I tell you!' But she waited for some minutes. Alice.",
          start_date: "2011-06-18",
          end_date: "2011-12-18",
          created_at: "2018-11-30 11:05:53",
          updated_at: "2018-11-30 11:05:53",
          deleted_at: null,
          matchPoints: 450,
          distance: "12",
          image: null,
          skills: [
            {
              id: 5,
              name: "SQL",
              pivot: { internship_id: 2, skill_id: 5, level: 1 }
            }
          ]
        }
      ]
    };
  },
  methods: {
      move(index) {
        this.internships.shift();
        console.log(index);
      }
  },
  created() {
    switch (runtime.token.role) {
      case "1":
        this.role = "Student";
        break;
      case "2":
        this.role = "Company";
        break;
      case "3":
        this.role = "Admin";
        break;
    }
  }
};
</script>