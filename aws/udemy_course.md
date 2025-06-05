## Section 6: EC2 Instance Storage

An Elastic Block Store (EBS) Volumne is a network drive you can attach to your instances while they run.
- It allows persist data even after their termination
- Bound to a specific available zone (moveable using snapshots)

Ec2 instances have a "Delete on temination" attribute. By default the root volumen is deleted when the EC2 instance is terminated. Any other EBS volumes are not deleted by default. This is the default value for the "Delete on termination" attribute.

### EBS Snapshots
- make a backup at a point in time
- Not necessary to detach volume to do snapshot, but recommended
- Can copy snapshots across AZ or Region
- EBS snapshot Archive
  - 75% cheaper
  - Take 24 to 72 hours for restoring
- Recycle Bin for Snapshots
  - Rules to retain deleted snapshots
  - specify retention (from 1 day to 1 year)
- Fast Snapshot Restore (FSR)
  - Force full initialization of snapshot to have no latency on the first use (cost a lot of money)

### AMI: Amazon Machine Image

AMI are a customization of an EC2 instance:
- You add your own software, configuration, operating system, monitoring ...
- Faster boot/configuration time because all your software is pre-package
- Are built for a specific region but the can be copied across region
- You can launch EC2 instances from public AWS, your own AMI, or AWS marketplace.

### EC2 Instance Store

ABS volumes are network drives, EC2 instace stores are hard drive attached to the physical server.
- Better I/O performance
- If the EC2 instance lose their storage if they're stopped
- Good for buffer / cache / scratch data / temporary content

### EBS Volume types

There are 6 Types:
- gp2/gp3 (SSD): General purpose SSD volume that balances price and performance for a wide variaty of workloads
  - Only gp2/gp3 and io1/io2 Block Express can be sed as boot volumes. In Gp3 you can set IOPS and throughput (amount of data transferred) independently, in gp2 they are linked.
- io1/io2 Block Express (SSD): Highest-performance SSD volume for mission-critical low-latency or high-throughput workloads
  - Provisioned IOPS. For applications that need more than 16.000 IOPS. Great for databases workloads.
  - Supports EBS Multi-attach
- st1 (HDD): low cost HDD volume designed for frequently accessed, throughput-intensive workloads
- sc1 (HDD): lowest cost HDD volume designed for less frequently accessed workloads.

EBS volumes are created for a specific AZ. It's possible migrate them between different AZ's using EBS snapshots.

### EBS Muti-Attach io1/io2 family

Attach the same EBS volume to multiple EC2 instances in the same AZ

- Each instance has full read & write permissions.
- Up to 16 EC2 Instances at a time.
- Must use a file system thats's cluster-aware.
- Use case:
  - Higher application availability in clustered Linux Applications (Teradata)
  - Application must manage concurrent write operations
 
### Amazon EFS - Elastic File System

It a NFS (network file system) that can be mounted on many ec2.
- EFS works with EC2 instances in multi-AZ
- Highly available, scalable, expensive (3x gp2) pay per use)
- Uses security group to ontrol access to EFS
- Compatible with Linux based AMI (not windows)
- File system scales automatically, pay-per-use, no capacity planning.

Performance
- Performance Mode
  - General purpose (default): latency-sensitive uses cases
  - Max I/O: higher latency, throughput, highly parallel

- Troughput mode
  - Bursting
  - Provisioned
  - Elastic (depends on the workload)

Storage Classes
- Storage Tiers: implement lifecicly policies to move files between storage tiers
  - Standard: for frequently accessed files
  - infrequent access (EFS-IA): cheaper to retrieve files
  - Archive: rarely accessed data, few times each year, 50% cheaper

- Availability and durability
  - Standard: multi-az, great for prod
  - One AZ: great for dev, backup enabled by default, compatible with IA

### EBS vs EFS 

