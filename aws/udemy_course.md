
## EC2 Instance Storage

Elastic Block Store (EBS) Volumnes come in 6 Types:
- gp2/gp3 (SSD): General purpose SSD volume that balances price and performance for a wide variaty of workloads
  - Only gp2/gp3 and io1/io2 Block Express can be sed as boot volumes. In Gp3 you can set IOPS and throughput (amount of data transferred) independently, in gp2 they are linked.
- io1/io2 Block Express (SSD): Highest-performance SSD volume for mission-critical low-latency or high-throughput workloads
  - Provisioned IOPS. For applications that need more than 16.000 IOPS. Great for databases workloads.
  - Supports EBS Multi-attach: attch the same EBS volume to multiple AC2 instances in the same AZ. Up to 16 EC2 Instances at a time. Must use a file system thats's cluster-aware.
- st1 (HDD): low cost HDD volume designed for frequently accessed, throughput-intensive workloads
- sc1 (HDD): lowest cost HDD volume designed for less frequently accessed workloads.

EBS volumes are created for a specific AZ. It's possible migrate them between different AZ's using EBS snapshots.

By default the root volumen is deleted when the EC2 instance is terminated. Any other EBS volumes are not deleted by default. This is the default for "Delete on termination" attribute.

Amazon Machine Images (AMIs) are specific to each AWS Region. You would need to first copy the AMI to the target region and then use it to launch your instance there.
