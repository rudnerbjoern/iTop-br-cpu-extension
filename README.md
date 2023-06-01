# iTop-br-cpu-extension

Copyright (c) 2022-2023 Björn Rudner
[![License](https://img.shields.io/github/license/rudnerbjoern/iTop-br-cpu-extension)](https://github.com/rudnerbjoern/iTop-br-cpu-extension/blob/main/LICENSE)

## What?

Save information on sockets and cores of physical CPUs.

This information can be useful for reporting licensing information.

You can synchronize this information by customizing the [vSphere data collector](https://github.com/Combodo/itop-data-collector-vsphere).

## How?

### Screenshot

![Server: More information](Screenshots/ServerMoreInformation.png)

### Class: Server

Add the following fields:

* CPU Sockets - Number of physical sockets / Number of CPUs in this Server
* CPU Cores - Number of Cores per CPU
* CPU Count (calculated) - Number of total Cores in this Server (Sockets * Cores)
