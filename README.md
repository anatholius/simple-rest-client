# Example `simple-rest-client`

Example repository to create simple REST client with `GET` and `POST`
using `phpspec` to design it.

## Outline

> Here's a short description of what I want to achieve.

I want to prepare a simple `REST` client to communicate with the Api server
located in the `Docker` container. Note, the `docker-compose` file is not
included in the repository - it can be any Api endpoint.

The server is ready and there is no need to think about it. I want to do this on
a `spec-BDD` basis using `phpspec`. This means that I will design the classes
describing their behavior and then `phpspec` will assist me in creating them.
The developed specifications will also fulfill the function of unit tests. After
design is complete, the specifications to be executed will be `PHPUnit` tests.

## State

Steps to reach the guidelines and the status of their implementation:

- [x] (Release `step_1`) Prepare project
    - [x] Write `README` to describe current situation
    - [x] Install dependencies
    - [x] Configure environment
- [ ] (Release `step_2`) Designing a `RestClient` structure using `phpspec`
    - [x] Design the `DotEnv`
    - [x] Design the `Transport/Curl`
    - [.] Design the `Client`
    - [ ] Design the `Response` structure
        - [ ] `success`
        - [ ] `data`
        - [ ] `error`
- [ ] (Release `step_3`) Testing client
    - [ ] Design `ApiController`
    - [ ] Design the `Request`
        - [ ] `headers`
        - [ ] `type`
    - [ ] Tests with success and failed responses
- [ ] Complete the documentation:
    - [ ] `README` file
    - [ ] (optional) `docs` folder
- [ ] Tests before publishing

Additionally:

- [ ] (Release `step_4`) Designing an abstraction to handle `HTTP` communication
  based on the [`PSR-7` specification](https://www.php-fig.org/psr/psr-7/)
  using `phpspec`
    - [ ] Design `Transport/Psr7`
    - [ ] Implement standard
    - [ ] Modify the `RestClient` structure to allow the selection of the
      transport pattern

## Prerequisites

What things you need to install the software and how to install them?

`TODO`

```
//example
```

## Resources

```shell
git clone https://github.com/anatholius/simple-rest-client.git
```
