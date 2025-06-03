## Section 6: EC2 Instance Storage

- An Elastic Block Store (EBS) Volumne is a network drive you can attach to your instances while they run.
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
- You can launch EC2 instances from:
  - 


  
- come in 6 Types:
- gp2/gp3 (SSD): General purpose SSD volume that balances price and performance for a wide variaty of workloads
  - Only gp2/gp3 and io1/io2 Block Express can be sed as boot volumes. In Gp3 you can set IOPS and throughput (amount of data transferred) independently, in gp2 they are linked.
- io1/io2 Block Express (SSD): Highest-performance SSD volume for mission-critical low-latency or high-throughput workloads
  - Provisioned IOPS. For applications that need more than 16.000 IOPS. Great for databases workloads.
  - Supports EBS Multi-attach: attch the same EBS volume to multiple AC2 instances in the same AZ. Up to 16 EC2 Instances at a time. Must use a file system thats's cluster-aware.
- st1 (HDD): low cost HDD volume designed for frequently accessed, throughput-intensive workloads
- sc1 (HDD): lowest cost HDD volume designed for less frequently accessed workloads.

EBS volumes are created for a specific AZ. It's possible migrate them between different AZ's using EBS snapshots.



Amazon Machine Images (AMIs) are specific to each AWS Region. You would need to first copy the AMI to the target region and then use it to launch your instance there.
