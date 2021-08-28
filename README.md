# GraphQL POC

Just a GraphQL proof of concept

Categories with associated products example


## Installation

Just run: ``` make install ```


## Running the application

Just run: ``` make run ```

And then point your browser to ``` http://localhost:8000/?query={categories(id:1){name,description,products(first:2,after:%22YXJyYXljb25uZWN0aW9uOjI=%22){edges{cursor,node{name,description,price}}}}} ```

And to create a product for the category id 1, just run the following mutation inside ``` localhost:8000/graphiql ```

``` mutation {
  createProducts(input: {
    name: "TestFromMutationName2",
    description: "TestFromMutationDescription2",
    price: 2.4,
    category: 1
  }) {
    id,
    name,
    price
  }
} ```


## Cleaning the application

Just run: ``` make clean ```

