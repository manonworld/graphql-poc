# GraphQL POC

Just a GraphQL proof of concept

Categories with associated products example


## Installation

Just run: ``` make install ```


## Running the application

Just run: ``` make run ```

And then point your browser to ``` http://localhost:8000/?query={categories(id:1){name,description,products(first:2,after:%22YXJyYXljb25uZWN0aW9uOjI=%22){edges{cursor,node{name,description,price}}}}} ```


## Cleaning the application

Just run: ``` make clean ```

