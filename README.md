#CarafeDB
###Index
 - [About](#about)
 - [State of CarafeDB](#state-of-carafedb)
  - [Available Functionality](#available-functionality)
  - [TODO Functionality](#todo-functionality)
 - [FAQ](#faq)

##About
CarafeDB is a proof of concept for data storage in a flat file that is
accessible using SQL-like functionality, and licensed under the MIT Open Source
license.

Carafe uses a common structure (JSON) to store any contents in a single file,
where each line of the database is a new row.

```
Note: Due to the limitations of PHP not shipping with multi-threading, this is
not a solution aimed at getting production quality performance, but rather an
experiment on the feasibility of such a product in a sparsely used system.
```

```
Note: The structure of CarafeDB is subject to change before the initial release.
```

##State of CarafeDB
The central focus of CarafeDB is adding functionality over performance. Before
the initial release benchmarks will be added and the focus will shift to
performance.

###Available Functionality
 - select
  - Select by column(s) with wildcard support.
 - insert
 - delete (by row)
 
###TODO Functionality
 - delete (by property)
 - update
 - benchmarks

##FAQ
1) What is Carafe?
 ```
 A Carafe is an open-topped glass flask typically used for serving wine or
 water.
 ```
