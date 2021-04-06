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

---

**Now `simple-rest-client` is designed, and can be used to educational goals.**

These are mainly the steps of designing a class structure based on
the `spec-BDD` principle. Also, I used here `RDD` (Readme Driven Design)
methodology to direct the work on the basis of: _"Before you start doing
something, write down what you want to do"_.

**The example is written
using ![APM](https://img.shields.io/badge/PHP-8.0.3-darkgreen).**

However, for version ![APM](https://img.shields.io/badge/PHP-7.4-yellow),
a [special branch](https://github.com/anatholius/simple-rest-client/tree/php74)
has been created, if someone would like to use a ready-made for this version.
There are mainly semantic changes there.

## Prerequisites

What things you need to install the software and how to install them?

You need to have `composer` installed, of course  `PHP`, and that's all. After
that all you need to install `phpspec`, but what you will learn next follow the
commits 😉.

## Resources

There it is.

```shell
git clone https://github.com/anatholius/simple-rest-client.git
```

## State

> After the main work is completed, and the last major step of this `wishlist`
> is released, the `State` section is moved to the bottom of this document.
>
> Further, work may change its content, but it is no longer a priority.

Steps to reach the guidelines and the status of their implementation:

- [x] (Release `step_1`) Prepare project
    - [x] Write `README` to describe current situation
    - [x] Install dependencies
    - [x] Configure environment
- [x] (Release `step_2`) Designing a `RestClient` structure using `phpspec`
    - [x] Design the `DotEnv`
    - [x] Design the `Transport/Curl`
    - [x] Design the `Client`
    - [x] Design the `Response` structure
        - [x] `success`
        - [x] `data`
        - [x] `error`
        - [x] Use it in transport
- [x] (Release `step_3`) Testing client
    - [x] Design `ApiController`
    - [x] Tests with success and failed responses
- [x] Complete the documentation:
    - [x] `README` file
    - ❌ (optional) `docs` folder
- [x] Tests before publishing

Additionally:

- [ ] (Release `step_4`) Designing an abstraction to handle `HTTP` communication
  based on the [`PSR-7` specification](https://www.php-fig.org/psr/psr-7/)
  using `phpspec`
    - [ ] Design `Transport/Psr7`
    - [ ] Implement standard
    - [ ] ❔ Design the `Request` - is it needed?
        - [ ] `headers`
        - [ ] `type`
    - [ ] Modify the `RestClient` structure to allow the selection of the
      transport pattern
