import apiV1 from './apiV1'; 

const getTags = async () => {
  try {
    const response = await apiV1.get('/tags');
    return response.data;
  } catch (error) {
    console.error('Error fetching tags:', error);
    throw error;
  }
};

export default {
  getTags
};


// import axios from "axios";


// class TagService {
//   async getTags() {
//     return await  apiV1.get('/tags', {
//         params: {
//           // per_page: 10,
//         },
//       })
//       .then((response) => response.data)
//       .catch((error) => console.log(error));
//   }
//   // async getPosts() {
//   //   return await axios
//   //     .get(API_URL + "posts", {
//   //       params: {
//   //         _page: 1,
//   //         _limit: 5,
//   //         _sort: "id",
//   //         _order: "desc",
//   //       },
//   //     })
//   //     .then((response) => response.data)
//   //     .catch((error) => console.log(error));
//   // }

//   // getPostById(id) {
//   //   return axios.get(API_URL + "posts/" + id);
//   // }

//   // create(data) {
//   //   return axios.post(API_URL + "posts", data);
//   // }

//   // update(id, data) {
//   //   return axios.put(API_URL + "posts/" + id, data);
//   // }

//   // delete(id) {
//   //   return axios.delete(API_URL + "posts/" + id);
//   // }

//   // deleteAll() {
//   //   return axios.delete(API_URL + "posts");
//   // }

//   // findByTitle(title) {
//   //   return axios.get(API_URL + "posts?title=" + title);
//   // }
// }

// export default new TagService();